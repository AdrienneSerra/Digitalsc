These commands were used to make code changes based on the Omeka Instance.

For our example below we will be adding new "AmesomePlugin".

## Get the latest code

From digitalsc on your local host:
```
git pull
```

(make your code changes on local host)


## Connect to your virtual machine to sync the changes
Connect to your VM.
```
vagrant ssh digitalscvm
sudo -s
cd /vagrant/
rsync -av omeka-2.3/plugins /var/www/html/omeka-2.3/plugins
```

## Restart Apache Webserver

From your VM:
```
sudo service apache2 restart
```


## Test

Your changes will be available again shortly at http://192.168.15.11.

## Push changes up to the repository

If tests were successful logout of the VM

```
exit
```

Then make the commits to the repository from the localhost.

```
git add .
git commit -m "added new awesome plugin for omeka"
git push
```
