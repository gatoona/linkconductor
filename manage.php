<?php
/**
 * Link Conductor
 * Simple URL redirect platform with manager
 * @author Jeffrey Wang (jeffw16)
 * @license MIT License
*/
$password = '123password456';

$redirectsfilename = __DIR__ . '/redirects.json';
$filecontents = file_get_contents( $redirectsfilename );
/*
$redirects = json_decode( $filecontents, true );
$i = 0;
foreach ( $redirects as $short => $full ) {
  ?>
  <input type="text" class="short" name="<?php echo 'short-' . $i; ?>" id="<?php echo 'short-' . $i; ?>" value="<?php echo $short; ?>">
  <input type="text" class="full" name="<?php echo 'full-' . $i; ?>" id="<?php echo 'full-' . $i; ?>" value="<?php echo $full; ?>">
  <br />
  <?php
}
*/
?>
<!DOCTYPE html>
<html>
<head>
  <title>Link Conductor Manager</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
  <div class="container">
    <div class="row">
      <h1>Link Conductor Manager</h1>
      <?php
      if ( $_POST['action'] === 'save' && $_POST['password'] === $password ) {
        $total = $_POST['total'];
        $redirects = [];
        for ( $i = 1; $i <= $total; $i++ ) {
          $redirects[$_POST['short-' . $i]] = $_POST['link-' . $i];
        }
        $redirectsjson = json_encode($redirects);
        file_put_contents( $redirectsfilename, $redirectsjson );
        ?>
        <p class="lead">Saved!</p>
        <p>Your links were successfully saved.</p>
        <a href="manage.php">Return to Link Conductor Manager</a>
        <?php
      } elseif ( $_POST['password'] === $password ) {
        ?>
        <form id="form" action="manage.php" method="post">
          <div id="linkmanager"></div>
          <a href="#" class="btn btn-success" id="add">+</a>
          <a href="#" class="btn btn-danger" id="remove">-</a>
          <button type="submit" class="btn btn-primary">Save links</button>
          <input type="hidden" name="action" value="save" />
          <input type="hidden" name="password" value="<?php echo $_POST['password']; ?>" />
          <input type="hidden" name="total" id="total" value="0" />
        </form>
        <?php
      } else {
        ?>
        <form id="form" action="manage.php" method="post">
          <div class="form-group">
            <input type="password" class="form-control" name="password">
          </div>
          <button type="submit" class="btn btn-primary">Log in</button>
        </form>
        <?php
      }
      ?>
    </div>
  </div>
  <!-- jQuery [3.2.1] (Google Hosted Libraries) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!-- Twitter Bootstrap [3.3.7] (Bootstrap CDN) +SRI -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <script>
  var redirects = <?php echo $filecontents; ?>;
  var total;
  function settotal( newtot ) {
    total = newtot;
    $('#total').attr('value', newtot);
    return newtot;
  }
  function gettotal() {
    return total;
  }
  function add( i, short, link ) {
    $('#linkmanager').append('<div id="formgroup-' + i + '" class="row form-group">')
    $('#formgroup-' + i).append('<div id="col-left-' + i + '" class="col-md-6">')
    $('#col-left-' + i).append('<input type="text" class="short form-control" name="short-' + i + '" id="short-' + i + '" value="' + short + '">');
    $('#formgroup-' + i).append('<div id="col-right-' + i + '" class="col-md-6">');
    $('#col-right-' + i).append('<input type="text" class="link form-control" name="link-' + i + '" id="link-' + i + '" value="' + link + '">');
    $('#formgroup-' + i).append('<br />');
  }
  function remove( i ) {
    $('#formgroup-' + i).remove();
  }
  $(function() {
    var i = 0;
    $.each(redirects, function( short, link ) {
      add( ++i, short, link );
    });
    settotal( i );
    console.log('Total links: ' + total);
  });
  $('#form').on('click', '#add', function( event ) {
    add( settotal(gettotal() + 1), '', '' );
  });
  $('#form').on('click', '#remove', function( event ) {
    remove( gettotal() );
    settotal( gettotal() - 1 );
  });
  </script>
</body>
</html>
