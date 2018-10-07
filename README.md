# About
This is a simple Docker WordPress + DB repo. It's based on the default WordPress Docker image, which is built on 
Apache2. DB is a MYSQL server built on MariaDB.

# Installation (Mac)
- Make sure you have Docker
`brew cask install docker`
- Clone the Repo
- Update .env settings

# Production Environment
## Setting Up the Production Environment (Digital Ocean)
### Creating an Instance
- Update the server settings in prod.yml
- Create a Docker Droplet (One-click apps), give your SSH settings
- ssh into Droplet
`ssh root@{droplet ip address}`
- Generate SSH Key
`ssh-keygen -q -t rsa -N '' -f /root/.ssh/id_rsa`
- Copy the SSH Key and add it to BitBucket Readonly access, to give the server access to repo
`cat /root/.ssh/id_rsa.pub`
- Pull the repo to production server (Make sure the REPO_URL is defined in .env)
`git clone $REPO_URL /root/web`
- Start the server
`cd /root/web`
`docker-compose -f prod.yml up -d`
- Docker container will always run, even on system reboot (per docker prod.yml restart:always).

### Configuring Volume
You'll need to host DB and the site files on a separate Volume. That way when you redeploy the Production, it can
continue using the existing DB and Upload files.
TODO - Instructions

### Additional Settings
Optionally, you can configure the server settings by changing the files in /docker-settings/wordpress

## Updating the Production Environment
SSH into your prodoction server, update the repo and relaunch the Docker script (in-case of .env/container changes)
`ssh root@{droplet ip address}`
`git -C /root/web pull`
`docker-compose -f prod.yml up -d`

# Cheatsheet
- Import Database
docker-compose -f prod.yml exec db bash -c 'mysql -u root -p$MYSQL_ROOT_PASSWORD -D $MYSQL_DATABASE -e "SET autocommit=0; source /tmp/wordpress.sql; COMMIT"'
- Export Database
docker-compose -f prod.yml exec db bash -c '/usr/bin/mysqldump -u root -p$MYSQL_ROOT_PASSWORD $MYSQL_DATABASE' > /tmp/wordpress.sql