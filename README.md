charm-bootstrap-ansible
=======================

A quick way to get started creating a [juju][1] charm using
[ansible][2].

Disclaimer: this template does not try to explain what's possible with
either ansible or juju - but if you know a bit about both, it will
show you how you can easily use them together.

Make sure you have both git and bzr installed and then:

```
$ mkdir -p charms/precise && cd charms/precise
$ git clone https://github.com/absoludity/charm-bootstrap-ansible.git mycharm
$ cd mycharm
$ make
```

That will pull in the required charm-helpers library and run the unit-tests.
Take a look around at the hooks/hooks.py or the playbooks/site.yaml,
or deploy it with:

```
$ juju deploy --repository=../.. local:charm-bootstrap-ansible
```

If you'd like to explore what's happening when the hooks run,
once juju status tells you that the services has 'started', you can
open another terminal up and run

```
$ juju debug-hooks charm-bootstrap-ansible/0
```

Back in your original terminal, let's change one of the config
options (defined in the config.yaml):

```
$ juju set charm-bootstrap-ansible string-option="Hi there"
```

Back in your debug-hooks terminal, you'll see the prompt
has changed to let you know it's ready to run the config-changed
hook. Run the hook to see what it does with:

```
$ hooks/config-changed
```

You'll see the output of ansible running all the tasks tagged with
'config-changed', including a debug message with the value of
the config option that you changed. Just 'exit' to let juju know
the hook execution has finished.

Have fun exploring the possibilities of ansible and juju!

### Note about Dependencies
The makefile to run tests requires the following dependencies

- python-nose
- python-mock
- python-flake8

installable via: 

```
$ sudo apt-get install python-nose python-mock python-flake8
```

[1]: http://juju.ubuntu.com/
[2]: http://ansibleworks.com/
