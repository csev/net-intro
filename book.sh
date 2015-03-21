#! /bin/sh

rm tmp.* *.tmp *.aux
pandoc A1-preface.mkd -o tmp.prefacex.tex
sed < tmp.prefacex.tex 's/section{/section*{/' > tmp.preface.tex
pandoc -s -N --toc --default-image-extension=eps -V fontsize:11pt -V documentclass:book --template=template.latex [0-9]*.mkd -o tmp.tex

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

