phpunit:
		@vendor/bin/phpunit --stderr

phpunitNoCov:
		@vendor/bin/phpunit --stderr --no-coverage

phpunitHtmlCov:
		@vendor/bin/phpunit --stderr --coverage-html ./code-coverage