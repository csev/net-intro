#! /bin/sh

rm *.tmp *.aux
pandoc -s -N --toc --default-image-extension=eps -V fontsize:11pt -V documentclass:book --template=template.latex *.mkd -o tmp.tex

latex tmp
makeindex tmp
latex tmp
dvipdf tmp.dvi x.pdf
if [[ "$OSTYPE" == "darwin"* ]]; then
  open x.pdf
elif [[ "$OSTYPE" == "linux-gnu" && -n "$DISPLAY" ]]; then
  xdg-open x.pdf
else
  echo "Output on x.pdf"
fi

rm tmp.*

