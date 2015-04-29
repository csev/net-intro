#! /bin/bash

# You might need to install the Alex or Samantha voices
# In Preferences / Dictation & Speech

rm audio/*

name='Samantha'
for f in [0-9]*.mkd
do
 x=`basename $f .mkd`
 echo "Processing $f $x"
 # echo $name
 pandoc $f -t plain | sed '/^Glossary/,$d' | cat - audio.postamble | say -v $name -o audio/$x.mp4 --file-format=mp4f
 if [[ "$name" == "Samantha" ]]
 then
  name="Tom"
 else
  name="Samantha"
 fi
done
