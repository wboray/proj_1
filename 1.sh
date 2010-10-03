#!/bin/sh
for i in `find . -name '*.*' -type f`
    do
		echo "Converting file $i to UTF-8 encoding..."
		mv $i $i.icv
		iconv -f WINDOWS-1251 -t UTF-8 $i.icv > $i
		rm -f $i.icv
    done

