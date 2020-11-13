#!/usr/bin/env python
# coding: utf-8

# In[1]:


import pandas as pd
from math import log10
data = pd.read_csv("../data/data.csv", encoding='utf-8',delimiter=";")

SENW = {'S': 0, 'E': 1, 'N': 2, 'W': 3}
LP = {'l': 0, 'p': 1}
ETAGES = {'-1': 0, '0': 1, '1': 2, '2': 3, '3': 4, '4': 5, '5': 6, '6': 7}
macs = {}

def res2df(x, i):
    a = x.split('|')
    a[0] = LP[a[0]]
    a[1] = SENW[a[1]]
    a[2] = ETAGES[a[2]]
    return int(a[i])

def mac2id(x):
    if macs.get(x):
        return macs[x]
    macs[x] = len(macs)
    return int(macs[x])

for x in range (0, 10):
    data['mac'+str(x)] = data['mac'+str(x)].apply(lambda x: mac2id(x))
    data['dbm'+str(x)] = 10 ** (( 27.55 - (20 * log10(2400)) + data['dbm'+str(x)] ) / 20 )
    data['ssid'+str(x)] = data['ssid'+str(x)].apply(lambda x: mac2id(x))
#    data['X'] = data
data['res0'] = data['res'].dropna().apply(lambda x: res2df(x, 0))
data['res1'] = data['res'].dropna().apply(lambda x: res2df(x, 1))
data['res2'] = data['res'].dropna().apply(lambda x: int(res2df(x, 2)))

target = [
    ['l', 'p'],
    ['S', 'E', 'N', 'W'],
    ['-1', '0', '1', '2', '3', '4', '5', '6'], 
    [''] * 200
]


# In[2]:


datalearn = data[data['res'].isna() == False]
datalearn


# In[3]:


import numpy as np

X = datalearn[['dbm0', 'mac0']].values
y0 = datalearn[['res0']].values
y1 = datalearn[['res1']].values
y2 = datalearn[['res2']].values
for i in range(1, 10): 
    nan_dbm = datalearn['dbm'+str(i)].isna() == False
    nan_mac = datalearn['mac'+str(i)].isna() == False
    nan = nan_dbm & nan_mac
    X = np.append(X, datalearn[['dbm'+str(i), 'mac'+str(i)]][nan].values, axis = 0)
    y0 = np.append(y0, datalearn[['res0']][nan].values, axis = 0)
    y1 = np.append(y1, datalearn[['res1']][nan].values, axis = 0)
    y2 = np.append(y2, datalearn[['res2']][nan].values, axis = 0)

#len(X)

X = pd.DataFrame(X)
y0 = pd.DataFrame(y0)
y1 = pd.DataFrame(y1)
y2 = pd.DataFrame(y2)


# In[4]:


from sklearn.ensemble import GradientBoostingClassifier

lr0 = GradientBoostingClassifier(random_state=1, n_estimators=100)
lr0 = lr0.fit(X, y0.values.ravel())
new_learn_score0 = lr0.score(X, y0)
lr1 = GradientBoostingClassifier()
lr1 = lr1.fit(X, y1.values.ravel())
new_learn_score1 = lr1.score(X, y1)
lr2 = GradientBoostingClassifier()
lr2 = lr2.fit(X, y2.values.ravel())
new_learn_score2 = lr2.score(X, y2)


[new_learn_score0, new_learn_score1, new_learn_score2]


# In[5]:


sample = datalearn.sample()

X = sample[['dbm0', 'mac0']].values
y0 = sample[['res0']].values
y1 = sample[['res1']].values
y2 = sample[['res2']].values
for i in range(1, 10): 
    nan_dbm = sample['dbm'+str(i)].isna() == False
    nan_mac = sample['mac'+str(i)].isna() == False
    nan = nan_dbm & nan_mac
    X = np.append(X, sample[['dbm'+str(i), 'mac'+str(i)]][nan].values, axis = 0)
    y0 = np.append(y0, sample[['res0']][nan].values, axis = 0)
    y1 = np.append(y1, sample[['res1']][nan].values, axis = 0)
    y2 = np.append(y2, sample[['res2']][nan].values, axis = 0)

res0 = pd.DataFrame(lr0.predict_proba(X))
mean0 = pd.DataFrame(res0.mean())
r0 = mean0.sort_values(by=0, ascending=False).index[0]

res1 = pd.DataFrame(lr1.predict_proba(X))
mean1 = pd.DataFrame(res1.mean())
r1 = mean1.sort_values(by=0, ascending=False).index[0]

res2 = pd.DataFrame(lr2.predict_proba(X))
mean2 = pd.DataFrame(res2.mean())
r2 = mean2.sort_values(by=0, ascending=False).index[0]

s0 = lr0.predict(X)
s1 = lr1.predict(X)
s2 = lr2.predict(X)

print("resultat {}\nres ind\t{}\nmesure\t({})".format([r0, r1, r2], [[int(s0[0]), int(s1[0]), int(s2[0])], [int(s0[1]), int(s1[1]), int(s2[1])]], [int(y0.ravel()[0]), int(y1.ravel()[0]), int(y2.ravel()[0])]))


# In[6]:


predicted = []

for mesure in datalearn.values:
    data2predict = []
    for i in range (0, 10):
        x = mesure[i*3 + 1 : i*3 + 3]
        if x[0] > 0:
            data2predict.append(x)
    
    predicted.append([
        pd.DataFrame(pd.DataFrame(lr0.predict_proba(data2predict)).mean()).sort_values(by=0, ascending=False).index[0],
        pd.DataFrame(pd.DataFrame(lr1.predict_proba(data2predict)).mean()).sort_values(by=0, ascending=False).index[0],
        pd.DataFrame(pd.DataFrame(lr2.predict_proba(data2predict)).mean()).sort_values(by=0, ascending=False).index[0],
    ])
predicted = pd.DataFrame(predicted)
predicted


# In[7]:


origin = pd.DataFrame(datalearn[['res0', 'res1', 'res2']].values)
origin


# In[12]:


from sklearn.metrics import classification_report

origin[3] = origin[2] + origin[1]*10 + origin[0]*100
predicted[3] = predicted[2] + predicted[1]*10 + predicted[0]*100

for i in range(0,3):
    print(classification_report(origin[i], predicted[i], target_names=target[i]))

res = classification_report(origin[3], predicted[3], output_dict = True)
t = []
for i in res.keys():
    try:
        i = "{:03d}".format(int(float(i)))
        t.append(target[0][int(i[0])]+'|'+target[1][int(i[1])]+'|'+target[2][int(i[2])])
    except:
        continue
print(classification_report(origin[3], predicted[3], target_names=t))


# In[13]:


import joblib

tobesaved = [lr0, lr1, lr2, LP, SENW, ETAGES, macs]
files = joblib.dump(tobesaved, '../data/learner.lr')


# In[ ]:




