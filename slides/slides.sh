#! /bin/bash

for filename in *.inc 
do
    echo $filename
    bn=`basename -s inc $filename`
    cat template_top.htm ${bn}inc template_bottom.htm > ${bn}htm
done

