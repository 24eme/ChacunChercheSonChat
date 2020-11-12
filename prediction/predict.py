import joblib
import pandas as pd
from sklearn.ensemble import GradientBoostingClassifier
import sys
from math import log10

[lr0, lr1, lr2, LP, SENW, ETAGES, macs] = joblib.load('../data/learner.lr')
LP = {v: k for k, v in LP.items()}
SENW = {v: k for k, v in SENW.items()}
ETAGES = {v: k for k, v in ETAGES.items()}

data = pd.read_csv(sys.stdin, names=['dbm', 'chanel', 'mac', 'security', 'ssid'])

def mac2id(x):
    try:
        return macs[x]
    except:
        return None;

data['mac'] = data['mac'].apply(lambda x: mac2id(x))
data['dbm'] = 10 ** (( 27.55 - (20 * log10(2400)) - data['dbm'] ) / 20 )
data['ssid'] = data['ssid'].apply(lambda x: mac2id(x))

data = data.dropna()

X = data[['dbm', 'mac']].values

try:
    res0 = pd.DataFrame(lr0.predict_proba(X))
    mean0 = pd.DataFrame(res0.mean())
    r0 = mean0.sort_values(by=0, ascending=False).index[0]

    res1 = pd.DataFrame(lr1.predict_proba(X))
    mean1 = pd.DataFrame(res1.mean())
    r1 = mean1.sort_values(by=0, ascending=False).index[0]

    res2 = pd.DataFrame(lr2.predict_proba(X))
    mean2 = pd.DataFrame(res2.mean())
    r2 = mean2.sort_values(by=0, ascending=False).index[0]

    print('prediction: '+LP[r0] +' | '+ SENW[r1] +' | '+ ETAGES[r2])
except:
    pass
