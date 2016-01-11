#! /bin/sh

# For yucks make the epub
pandoc --default-image-extension=svg --epub-stylesheet=epub.css -V lang=spanish *.mkd -o x.epub

rm tmp.* *.tmp *.aux
pandoc A1-preface.mkd -V lang=spanish -o tmp.prefacex.tex
sed < tmp.prefacex.tex 's/section{/section*{/' > tmp.preface.tex
pandoc -s -N -f markdown+definition_lists --toc --default-image-extension=eps -V fontfamily:arev -V fontsize:11pt -V documentclass:book -V lang=spanish --template=template.latex [0-9]*.mkd -o tmp.tex

sed < tmp.tex '/includegraphics/s/jpg/eps/' | sed 's"includegraphics{../photos"includegraphics[height=3.0in]{../photos"' > tmp.sed
diff tmp.sed tmp.tex

mv tmp.sed tmp.tex
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

