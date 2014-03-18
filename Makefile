#!/usr/bin/make
PYTHON := /usr/bin/env python

build: sync-charm-helpers test

lint:
	@flake8 --exclude hooks/charmhelpers --ignore=E125 hooks
	@flake8 --exclude hooks/charmhelpers --ignore=E125 unit_tests
	@charm proof

test:
	@echo Starting tests...
	@PYTHONPATH=./hooks $(PYTHON) /usr/bin/nosetests --nologcapture unit_tests

bin/charm_helpers_sync.py:
	@bzr cat lp:charm-helpers/tools/charm_helpers_sync/charm_helpers_sync.py \
		> bin/charm_helpers_sync.py

sync-charm-helpers: bin/charm_helpers_sync.py
	@$(PYTHON) bin/charm_helpers_sync.py -c charm-helpers.yaml

deploy:
	@echo Deploying charm-bootstrap-ansible template.
	@juju deploy --repository=../.. local:charm-bootstrap-ansible
	@echo See the README for explorations after deploying.
