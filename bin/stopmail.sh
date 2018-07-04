#!/bin/sh

TRANSPORT=/etc/postfix/transport

if [ -z $1 ]; then
    echo "usage: stopmail.sh (mailaddress)"
    exit 1
fi

MAIL=$1
MAILESCAPED=`echo "${MAIL}" | sed -e 's/\\+/\\\\+/g' | sed -e 's/\\./\\\\./g'`

#check it is already stopped
grep -E "^$MAILESCAPED" $TRANSPORT > /dev/null 2>&1
ret=$?
if [ $ret -eq 0 ]; then
	echo "Already stopped $MAIL."
	exit 0
fi

echo "$MAIL	discard: 554 discard mail" >> $TRANSPORT
postmap $TRANSPORT
/etc/init.d/postfix reload

echo "Stopped $MAIL."
exit 0
