#!/bin/sh

TRANSPORT=/etc/postfix/transport

if [ -z $1 ]; then
    echo "usage: unstopmail.sh (mailaddress)"
    exit 1
fi

MAIL=$1
MAILESCAPED=`echo "${MAIL}" | sed -e 's/\\+/\\\\+/g' | sed -e 's/\\./\\\\./g'`

#check it is already stopped
grep -E "^$MAILESCAPED" $TRANSPORT > /dev/null 2>&1
ret=$?
if [ $ret -eq 1 ]; then
	echo "Not stopped $MAIL."
	exit 0
fi

sed -i -e "s/^$MAIL/#$MAIL/g" $TRANSPORT
postmap $TRANSPORT
/etc/init.d/postfix reload

echo "Unstopped $MAIL."
