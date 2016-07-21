#!/bin/bash
# chown www-data:www-data /app -R

cd /app
if [ ${GIT_COMMIT} != 'dev' ]
then
    git pull \
    && git checkout $GIT_COMMIT
fi

if [ "$ALLOW_OVERRIDE" = "**False**" ]; then
    unset ALLOW_OVERRIDE
else
    sed -i "s/AllowOverride None/AllowOverride All/g" /etc/apache2/apache2.conf
    a2enmod rewrite
fi

source /etc/apache2/envvars
tail -F /var/log/apache2/* &
exec apache2 -D FOREGROUND