
import os

incolumn = False
indiv = False
inhtml = False
insection = False
incode = False
inli = False
inul = False

def finishCode():
    global incode, outf, eatblank
    if ( incode ) : print ('</code></pre>', file=outf)
    incode = False
    eatblank = False

def finish() :
    global insection, inli, inul, outf, indiv, incolumn
    finishCode()
    if ( inli ) : print ('</li>', file=outf)
    inli = False
    if ( inul ) : print ('</ul>', file=outf)
    inul = False
    if ( indiv ) : print ('</div>', file=outf)
    indiv = False
    if ( incolumn ) : print ('<br clear="all">', file=outf)
    incolumn = False
    if ( insection ) : print('</section>', file=outf)
    insection = False

top = open('template_top.htm').read()
bottom = open('template_bottom.htm').read()

for f in sorted(os.listdir(os.getcwd())):
    if not f.endswith(".inc") :
        continue

    b = f[:-4]
    print(f,b)
    lines = open(b+'.inc').read().split('\n')
    outf = open(b+'.htm','w')
    outf.write(top);
    eatblank = False
    for line in lines:
        pieces = line.split()
        if line.startswith('<section') :
            finish()
            inhtml = True
            print(line.rstrip(), file=outf)
        elif line.startswith('</section') :
            finish()
            inhtml = False
            print(line.rstrip(), file=outf)
        elif line.strip() == '===1' :
            indiv = True
            incolumn = True
            print('<div style="float:left;width:50%;" class="centered">', file=outf)
        elif line.strip() == '===2' :
            print('</div>', file=outf)
            print('<div style="float:right;width:50%;padding-right:0px;">', file=outf)
        elif line.startswith('!') :
            print('<img src="'+line[1:].strip()+'">', file=outf)
        elif inhtml :
            print(line.rstrip(), file=outf)
        elif line.startswith('# ..') :
            finish()
            print('<section data-background="'+pieces[1]+'"', file=outf)
            print('   data-background-size="contain">', file=outf)
            print('</section>', file=outf)
        elif line.startswith('#') :
            finish()
            print('<section>', file=outf)
            print('<h2>'+line[1:].strip()+'</h2>', file=outf)
            insection = True
        elif line.startswith('    ') :
            if not incode:
                print('<pre><code>',end="", file=outf)
                incode = True
            if eatblank : print('', file=outf)
            eatblank = False
            print(line[4:].rstrip(), file=outf)
        elif line.startswith('*') :
            finishCode()
            if not inul :
                print ('<ul>', file=outf)
                inul = True
            print('<li>'+line[1:].strip()+'</li>', file=outf)
        else :
            if ( incode and len(line) == 0 ) :
                eatblank = True
                continue

            line = line.rstrip()
            if ( incode and len(line) > 0 ) :
                finishCode()
            print(line.strip(), file=outf)

    finish()
    outf.write(bottom);
    outf.close()
