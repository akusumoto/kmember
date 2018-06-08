#!/bin/sh

TRANSPORT=/etc/postfix/transport

if [ -z $1 ]; then
    echo "usage: unstopmail.sh (mailaddress)"
    exit 1
fi

MAIL=$1

#check it is already stopped
grep -E "^$MAIL" $TRANSPORT > /dev/null 2>&1
ret=$?
if [ $ret -eq 1 ]; then
	echo "Not stopped $MAIL."
	exit 0
fi

sed -i -e "s/^$MAIL/#$MAIL/g" $TRANSPORT
postmap $TRANSPORT

echo "Unstopped $MAIL."