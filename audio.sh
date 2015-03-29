#! /bin/bash

# You might need to install the Alex or Samantha voices
# In Preferences / Dictation & Speech

rm audio/*

for f in [0-9]*.mkd
do
 x=`basename $f .mkd`
 echo "Processing $f $x"
 pandoc $f -t plain | sed '/^Questions/,$d' | cat - audio.postamble | say -v Samantha -o audio/sam-$x.mp4 --file-format=mp4f
 pandoc $f -t plain | sed '/^Questions/,$d' | cat - audio.postamble | say -v Tom -o audio/tom-$x.mp4 --file-format=mp4f
done
