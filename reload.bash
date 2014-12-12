#!/bin/bash

if [ `hostname` != "abc" ];
then
    echo The command should be executed in the guest OS!
    exit 1
fi

php app/console cache:clear --env=prod
php app/console cache:warmup --env=prod

mysql -u root < 00-extra/db/create-empty-database.sql
php app/console doctrine:schema:update --force

#php app/console doctrine:fixtures -n
#php app/console fos:user:create admin admin@example.net loremipsum --super-admin
