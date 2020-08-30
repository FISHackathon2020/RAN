import gensim
import sys
import nltk

from src.parser.text_extractor import extract_text_from_document
from src.environment import RESUME_PATH,RESUME_DATASET_PATH
import os
import json

output_dict = {}
#RESUME_PATH = RESUME_DATASET_PATH

keywords = sys.argv[1].split("/")



model = gensim.models.Word2Vec.load(os.path.join("/Library/WebServer/Documents/python/hackathon/src/word_similarity","mymodel"))

related_words = []

keyword_dictionary = {}
for i,keyword in enumerate(keywords):
    word_vector = model.wv.similar_by_word(keyword, topn=int(len(model.wv.vocab)))
    word_vector = sorted(word_vector, key=lambda word: word[1])
    word_vector = word_vector[::-1]

    #print(keyword)
    #output_dict.update({"keyword_"+ str(i)  keyword})
    #print(word_vector[0:10])


    only_words = []

    for each in word_vector[0:10]:
        only_words.append(each[0])

    keyword_dictionary.update({keyword: only_words})
    related_words = related_words + word_vector
    output_dict.update({"relate":keyword_dictionary})

for keyword in keywords:
    related_words += [(keyword,1)]

related_words = sorted(related_words, key=lambda word: word[1])
related_words = related_words[::-1]


#
# print(related_words)
# print(len(related_words))
#
# print("start searching")


priority_list = []

for files in os.listdir(RESUME_PATH):
    text = extract_text_from_document(os.path.join(RESUME_PATH,files))
    count = 0
    score = 0
    triggered_word = []
    for searchword in related_words:
        if searchword[0] in text:
            score += searchword[1]
            count += 1
            triggered_word.append(searchword)
            # if count > 20:
            #     break

    triggered_word = sorted(triggered_word, key=lambda each: each[1])
    triggered_word = triggered_word[::-1]

    priority_list.append((score,files,triggered_word[0:10]))

    # print(files)
    # print(score)

priority_list = sorted(priority_list, key=lambda each: each[0])
priority_list = priority_list[::-1]

resumes = []
for resume in priority_list:
    human_dict = {}
    human_dict.update({"pdf":resume[1]})
    human_dict.update({"total_score": resume[0]})

    only_words = []
    for each in resume[2]:
        only_words.append(each[0])


    human_dict.update({"related_vocabs":only_words})
    resumes.append(human_dict)





output_dict.update({"priority":resumes})
#print(priority_list[0:10])


print(json.dumps(output_dict))