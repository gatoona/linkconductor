# Link Conductor
Link Conductor is a simple URL redirect platform with an easy-to-use, web-based management tool written in PHP and JavaScript.

## How to use
Installation is easy. All you have to do is to put Link Conductor in a directory. Set the management tool's password to something else by changing the variable `$password`'s value to something else. Then, feel free to edit redirects effortlessly with the management tool. Voilà, you're done!

## Caveats
At this time, our included `.htaccess` file can only support directory structures such as:

`https://www.example.com/r/`

where `r` is the Link Conductor directory. We do not support further-nested directory structures, such as:

`https://www.example.com/mysite/r/`

where `r` is the Link Conductor directory. Support for further-nested directory structures can likely be achieved by slightly modifying the `.htaccess` as appropriate and putting the `.htaccess` in a parent directory.
