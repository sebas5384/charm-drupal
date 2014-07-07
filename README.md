Drupal Juju charm
=======================

This charm delivers a full optimzed stack for Drupal including the following:

- Drupal 7.x (for now... see to-dos)
- Drush
- Nginx with the [Perusio's configurations][1]
- PHP-FPM 5.3.x
- Compass/Sass (it's an option)

### Charm configurations:
- **Drupal version**, currently supported 6 and 7. *Default: 7*
- **Drush version** to be installed. *Default: 6.x*
- **Profile name** like standard, minimal or testing. *Default: standard*
- **The site name**, used when is a fresh install. *Default: Your fresh new site*
- The **administrator user name** when is a fresh install. *Default: admin*
- The **administrator user email**. *Default: admin@localhost.com*
- The **administrator password**. When is a fresh install a new will be generated (search in the logs). *Default: null*
- **Install SASS/Compass**, so that means ruby and rubygems will be installed. *Default: true*
- **Drupal source**, from where the Drupal will be downloaded, currently supported a repository Git (Ex. git@host:path/repo.git) or 'drush' to download from the Drupal.org. Deploying from Git a Lullabot boilerplate based fork is expected https://github.com/TallerWebSolutions/drupal-boilerplate. *Default: drush*
- **Deploy ssh key**, an ssh key that is stored on the server and for example, grants access to a Git repository. Default: null
- **Database dump file** to import when installing Drupal from a Git repository, currently only raw (.sql) or compressed with gzip (.gz). Example: "/var/www/databases/dev-dump.sql" or "http://old-url.com/sites/default/files/backup-dump.sql.gz". *Default: null*
- **Drupal boilerplate source.** Git repository of the boilerplate to install in case it's a new project from scratch. *Default: https://github.com/TallerWebSolutions/drupal-boilerplate.git*
- **Drupal path.** In case you have an existant Drupal that hasn't use a boilerplate, you can always change this to /var/www for example. *Default: /var/www/docroot*

### Usage:
#### Download the charm from git:
```shell
mkdir -p ~/charms/precise
git clone git@github.com:sebas5384/charm-drupal.git ~/charms/precise/drupal
```

#### Fresh new install:
```shell
juju deploy --repository ~/charms local:precise/drupal
juju deploy mysql
juju add-relation mysql drupal
juju expose drupal
```

#### Existing Drupal project:
- Create a config file for the project:
```yaml
# file: project-x.yaml
drupal:
  drupal-source: 'git@github.com:sebas5384/project-x.git'
  drupal-version: 'dev'
  drupal-profile: 'panopoly'
  drupal-db-dump: '/var/www/databases/dev-dump.sql'
  deploy-key: |
    -----BEGIN RSA PRIVATE KEY-----
    MIIEpQIBAAKCAQEAq1pNv5PaDfm2vQix9xXdnFiDRRllzrs4oksrbE7/mdA5f10s
    oDsRkn2YYDu3/e9JggrZhYM5gDxKVrSObpEc+zjo5.......................
    ................................................................
    ................................................................
    ................................................................
    ................................................................
    ................................................................
    ................................................................
    ................................................................
    -----END RSA PRIVATE KEY-----
```
- Deploy the charm:
```shell
juju deploy --repository ~/charms --config ./project-x.yaml local:precise/drupal
juju deploy mysql
juju add-relation mysql drupal
juju expose drupal
```

### TODO'S:
- Drupal 8.x support.
- Some PHP configuration, like memory or max upload.
- PHP-FPM charm relation, making built-in PHP an option.
- Some Nginx configuration.
- Gluster FS relation, for scale/redundancy between units.
- Varnish relation.
- HA-Proxy relation.
- Apache Solr relation.
- Redis relation.

[1]: https://github.com/perusio/drupal-with-nginx
