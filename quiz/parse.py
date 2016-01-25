import os
import sys
import re
import json
import hashlib
import random
from collections import OrderedDict

def encode_answer(answer):
    global answer_suffix, answer_factor, do_encode
    if answer_suffix is False or answer_factor is False : return answer
    if do_encode is False : return answer
    if answer > 100 : return answer
    enc = (answer_factor * random.randrange(100, answer_factor)) + answer
    enc = int(str(enc)+str(answer_suffix) )
    return enc

def decode_answer(answer):
    global answer_suffix, answer_factor, do_encode
    if answer_suffix is False or answer_factor is False : return answer
    if answer < 100 : return answer
    anstr = str(answer)
    if anstr.endswith(str(answer_suffix)) :
        anstr = anstr[:-len(str(answer_suffix))]
    dec = int(anstr) % answer_factor;
    return dec

# Load the keys from config.php if they exist
answer_suffix = 89
answer_factor = 107
try:
    config = open('../config.php').read()
    x  = re.findall('answer_suffix = ([0-9]*)',config)
    if len(x) == 1 :
        answer_suffix = int(x[0])
    x  = re.findall('answer_factor = ([0-9]*)',config)
    if len(x) == 1 :
        answer_factor = int(x[0])
except:
    pass

print("answer_suffix="+str(answer_suffix), end=' ')
print("answer_factor="+str(answer_factor))

# Unit test every time - silent if it passes
do_encode = True
for i in range(99) :
    if i != decode_answer(encode_answer(i)) :
        print('Encode/Decode Test Failure',i,end=' ');
        print('Encode',encode_answer(i),end=' ');
        print('Decode',decode_answer(encode_answer(i)));

do_encode = False
if len(sys.argv) > 1 :
    if 'encode' in sys.argv:
        do_encode = True

if do_encode:
    print('Answers will be encoded in the output');
else :
    print(' ')
    print('Answers will be not encoded in the output');
    print('Any old anwers will be decoded if they are encoded');
    print('If you want answers encoded add the "encode" parameter to this call')
    print('')

pth = os.path.join(os.getcwd(),'..','book')
quizzes = OrderedDict()
for f in sorted(os.listdir(pth)):
    if ( f[0] < '0' or f[0] > '9' ) : continue
    if ( not f.endswith('.mkd') ) : continue
    print('Parsing',f)
    fname = os.path.join(os.getcwd(),'..','book',f)
    lines = open(fname, encoding="utf8").read().split('\n')
    quiz = OrderedDict()
    questions = list()
    answers = list()
    question = False
    answer = False
    inquestions = False
    prevline = False
    title = False
    for line in lines:
        if line.startswith('======') and prevline is not False and title is False:
            title = prevline
        prevline = line.rstrip()
        if line.strip() == 'Cuestionario' and not inquestions :
            inquestions = True
            continue
        if not inquestions : continue
        if line.strip() == '' : continue
        queslist = re.findall('^[0-9]*\. (.*)',line)
        anslist = re.findall('^[a-z]*\) (.*)',line)
        # print(line)
        if len(queslist) > 0 : 
            if question is not False and answer is not False : 
                question['answers'].append(answer)

            if question is not False : 
                questions.append(question)

            question = OrderedDict()
            # The first entry in the question array is the question
            answer = queslist[0].rstrip()
        elif len(anslist) > 0 : 
            if question is not False and answer is not False : 
                if len(question) == 0 :
                    question['question'] = answer
                    question['answer'] = 0
                    question['answers'] = list();
                else :
                    question['answers'].append(answer)
            answer = anslist[0].rstrip()
        elif answer is not False : 
            answer += ' ' + line.rstrip()
        elif question is not False : 
            question.append(line.rstrip())

    if question is not False and answer is not False : 
        if len(question) > 0 :
            question['answers'].append(answer)

    if question is not False and len(question) > 0 and len(question['answers']) > 0 : 
        questions.append(question)

    if title is False : continue
    if questions is False : continue
    if len(questions) == 0 : continue

    # print(title)
    # print(questions) 

    quiz['title'] = title
    quiz['questions'] = questions
    quizzes[f] = quiz

    # break

# Look for old quiz answers
try:
    old = open('quizzes.json','r').read()
    oldquiz = json.loads(old,object_pairs_hook=OrderedDict)
except:
    oldquiz = False

# extract the old answers into an md5-indexed dictionary
oldanswers = dict()
if oldquiz is not False :
    for f,quiz in oldquiz.items():
        for q in quiz['questions'] : 
            if 'answer' in q and 'md5' in q and q['answer'] > 0 :
                oldanswers[q['md5']] = decode_answer(q['answer'])

print('Loaded',len(oldanswers),'previous answers')

match = 0
missing = 0
for f,quiz in quizzes.items():
    for q in quiz['questions'] : 
        signature = q['question']
        for a in q['answers'] : 
            signature = signature + a
        md5 = hashlib.md5(signature.encode()).hexdigest()
        q['md5'] = md5
        if md5 in oldanswers:
            match = match + 1
            q['answer'] = oldanswers[md5]
        q['answer'] = encode_answer(q['answer'])
        if q['answer'] == 0 :
            missing = missing + 1

print('Copied',match,'previous answers into new json')
print('There are',missing,'questions without an answer')

outf = open('quiz_new.json','w')
print(json.dumps(quizzes,indent=4), file=outf)
print('New output on quiz_new.json')
