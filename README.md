# Share
<h4>A command line tool to easily share text between mac users</h4>

Share was inspired by a teammate who asked me to send over a password. I didn't really want to text it to him, and putting it in a file and scp'ing it over sounded like too much work. Share is basically a wrapper around scp and ssh. I remember there was a utility that did this featured on [Hacker News](https://news.ycombinator.com/) but I didn't save the link and I couldn't find it with The Google. If anyone knows what I'm talking about let me know in the issues :)

- Built on top of the [Laravel](https://laravel.com) components using Laravel Zero
- Currently only tested and used on a Mac.

------

## Documentation

## Prereqs
Because Share is built around ssh it will prompt for your teammates computer's password. To avoid this I recommend sharing one another's public keys.
You can place the contents of your teammates public key into your `~/.ssh/authorized_keys` file. If the file does't already exist, you can create it.

## Instalation
Clone the project from github and cd into the directory.
Run
`php share app:build`
./builds/share is the compiled phar file. At the moment, in order for share to work correctly you need to copy that into your `/usr/local/bin/` directory.

## Initialization
Before using share you will need to execute:
`share init`

This sets up the nessesary directories. (TODO: Remove the need for this command)

## Usage
At any time you can run `share` to see the version of share and all of the commands that share takes.

You will first need to add your teammates computer addresses. You can do this with the `hosts` command.
`share hosts:add jim jim@ipaddress`

You can check all of your hosts with
`share hosts:list`

You can remove a host with
`share hosts:remove jim`

Once you have a teammate entered sending text is easy.
`share secret:with jim mySuperSecret`
Jim will now have mySuperSecret in his clipboard.

You can also send files using the --file flag or (-F)
`share secret:with jim /path/to/file.txt --file`

You can list all of your received secrets with
`share secrets:list`

You can remove a secret by referencing the name to a secret from the `share secrets:list` command.
`share secrets:remove TheSeecretName`

## TODO
- Remove the need for the init command. This really just creates directories that should be created as they are needed as opposed to being created upfront with the init command.
- All secrets are stored in plane text inside the ~/.share/secrets directory. The files in this directory should be encrypted with a user defined password.
- We'll also want to have password managment commands like set password and reset password.
- Fix the `--file` option so that it can accept absolute directory refrences. As of now you must specify a file relative to your current working directory.
- Add a preferences command. I can think of one preference which is automatically copy to clipboard (YES|NO).
- Update the send command so that the share phar file doesn't have to be located at /usr/local/bin. I suspect this has something to do with the bash_profile not loading when executing scripts via ssh.
## License

Share is an open-source software licensed under the [MIT license](https://github.com/laravel-zero/laravel-zero/blob/stable/LICENSE.md).
