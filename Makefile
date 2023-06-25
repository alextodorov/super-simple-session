phpunit: export XDEBUG_MODE=coverage
phpunit:
		@vendor/bin/phpunit --stderr

phpunitNoCov:
		@vendor/bin/phpunit --stderr --no-coverage

phpunitHtmlCov: export XDEBUG_MODE=coverage
phpunitHtmlCov:
		@vendor/bin/phpunit --stderr --coverage-html ./code-coverage