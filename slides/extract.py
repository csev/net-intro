import os
import sys
import re
import json
import hashlib
from collections import OrderedDict

pth = os.path.join(os.getcwd(),'..','book')
quizzes = OrderedDict()
for f in sorted(os.listdir(pth)):
    if ( f[0] < '0' or f[0] > '9' ) : continue
    if ( not f.endswith('.mkd') ) : continue
    out_file = os.path.join(os.getcwd(),'convert',f)
    try:
        fhand = open(outfile)
        print(f, 'already exists in the convert directory - skipped')
        fhand.close()
        continue
    except:
        pass

    print('Parsing',f)
    fname = os.path.join(os.getcwd(),'..','book',f)
    lines = open(fname).read().split('\n')
    outf = open(out_file,'w')
    title = False
    prevline = False
    incode = False
    lastblank = False
    for line in lines:
        if line.strip() == 'Questions' : break
        if line.strip() == 'Glossary' : break
        linklist = re.findall('\[(.*)\]\((.*)\)',line)
        if line.startswith('======') and prevline is not False and title is False:
            print('# ', prevline, file=outf)
            lastblank = False
        elif line.startswith('---------') and prevline is not False and title is False:
            print('# ', prevline, file=outf)
            lastblank = False
        elif line.startswith('!') and len(linklist) == 1 :
            print('#['+linklist[0][0]+']('+linklist[0][1]+'.png)', file=outf)
            lastblank = False
        elif line.startswith('    '):
            if not incode and not lastblank: 
                print('', file=outf)
            incode = True
            print(line.rstrip(), file=outf)
            lastblank = False
        elif len(line.strip()) == 0 :
            if incode and not lastblank:
                print('', file=outf)
                lastblank = True
            incode = False

        prevline = line.rstrip()
