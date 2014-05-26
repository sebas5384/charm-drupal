# Drupal Juju Charm

This charm delivers a full stack optimzed to Drupal including the following:

- Drupal
- Nginx + PHP-FPM


## Overview

This charm provides (service) from (service homepage). Add a description here of what the service itself actually does.


## Usage


Step by step instructions on using the charm:

    juju deploy drupal

and so on. If you're providing a web service or something that the end user needs to go to, tell them here, especially if you're deploying a service that might listen to a non-default port.

You can then browse to http://ip-address to configure the service.

## Configuration

The configuration options will be listed on the charm store, however If you're making assumptions or opinionated decisions in the charm (like setting a default administrator password), you should detail that here so the user knows how to change it immediately, etc.


## Instalation

1. Based in https://juju.ubuntu.com/docs/getting-started.html run the following commands:

  ```
  sudo add-apt-repository ppa:juju/stable
  sudo apt-get update && sudo apt-get install juju-local
  juju generate-config
  ```

2. At ~/.juju/environments.yaml uncomment the line:

  `default-series: precise`

3. rund the following commnads:

  ```
  juju switch local
  juju bootstrap
  juju deploy juju-gui
  ```

4. When juju status retorns the conclusion of the *services*
5. Access the public-address ip
6. Use the password for the admin user, created at ~/.juju/environments/local.jenv (seccond line of the file)
7. At the JUJU dashboard, drag the MySQL Charm
8. Click at this charm Deploy.
9. Wait for the deploy to finish. The progress may be followed with:

  `tail -f /var/log/juju-[hostname]-local/all-machines.log`

10. At this point the charm-drupal from sebas5384, at github, is successfully cloned.

  By convension the following directory will be created:

  `/home/[user]/charms/precise`
11. At precise directory, clone the repo into the drupal directory

  `git clone https://github.com/sebas5384/charm-drupal.git drupal`

12. At drupal directory run:

  `git checkout bash`

13. To install Drupal run the following commnad:

  `juju deploy --repository ~/charms local:precise/drupal`

14. After the deploy is finished, at the JUJU dashboard, create the relation between Drupal and SQL.
25. After the relation is finhished, access the Drupal IP throught your favorite browser, available by the JUJU status.
16. Use the user *admin* and password *123123*.
17. To access the machine throught ssh, run the following command according the service id by the juju status:

  `juju ssh drupal/[id]`

## Contact Information

**Author:** Sebastian Ferrari and other [awesome contributors](https://github.com/sebas5384/charm-drupal/graphs/contributors)

**Report bugs at:** http://bugs.launchpad.net/charms/+source/charm-drupal

**Location:** http://jujucharms.com/charms/distro/charm-drupal
