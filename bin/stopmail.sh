#!/bin/sh

TRANSPORT=/etc/postfix/transport

if [ -z $1 ]; then
    echo "usage: stopmail.sh (mailaddress)"
    exit 1
fi

MAIL=$1

#check it is already stopped
grep -E "^$MAIL" $TRANSPORT > /dev/null 2>&1
ret=$?
if [ $ret -eq 0 ]; then
	echo "Already stopped $MAIL."
	exit 0
fi

echo "$MAIL	discard: 554 discard mail" >> $TRANSPORT
postmap $TRANSPORT

echo "Stopped $MAIL."
exit 0
