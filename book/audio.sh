#! /bin/bash

# You might need to install the Alex or Samantha voices
# In Preferences / Dictation & Speech

rm audio/*

name1='Samantha'
name1='Zoe (Premium)'
name1="Alex"

name2="Evan (Enhanced)"
name2="Nathan (Enhanced)"
name2='Samantha'
name2='Zoe (Premium)'

name=$name1
for f in [0-9]*.mkd
do
 x=`basename $f .mkd`
 echo "Processing $f $x $name"
 # echo $name
 pandoc $f -t plain | sed '/^Glossary/,$d' | cat - audio.postamble | say -v "$name" -o audio/$x.mp4 --file-format=mp4f
 if [[ "$name" == "$name1" ]]
 then
  name=$name2
 else
  name=$name1
 fi
done
