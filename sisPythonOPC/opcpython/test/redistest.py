import redis
import queue
from datetime import datetime
from varlist import No1Boilerlist,No2Boilerlist,No3Boilerlist,No4Boilerlist,Publiclist,Turbinelist,FGDlist
 
No1Boilerlist = No1Boilerlist.values()
No2Boilerlist = No2Boilerlist.values()
No3Boilerlist = No3Boilerlist.values()
No4Boilerlist = No4Boilerlist.values()
Publiclist = Publiclist.values()
Turbinelist = Turbinelist.values()
FGDlist = FGDlist.values()

try:
    pool = redis.ConnectionPool(host='192.168.2.124',port=6379,db=1,decode_responses=True)

    r = redis.Redis(connection_pool=pool)
    response = r.ping()
    print(response)
    #key = r.keys()
    #print(key)
    #q = queue.Queue()
    for item in No1Boilerlist:
        kks,comment = item
        if(kks.endswith('_FB',0,len(kks)-1)):
            hash_key = kks.replace('_',':')
        else:
            hash_key = kks+':V'
        user_data = {'value':999,'quality':0,'dcstime':' '}
        r.hset(hash_key,mapping=user_data)
    for item in No2Boilerlist:
        kks,comment = item
        if(kks.endswith('_FB',0,len(kks)-1)):
            hash_key = kks.replace('_',':')
        else:
            hash_key = kks+':V'
        user_data = {'value':999,'quality':0,'dcstime':' '}
        r.hset(hash_key,mapping=user_data)
    for item in No3Boilerlist:
        kks,comment = item
        if(kks.endswith('_FB',0,len(kks)-1)):
            hash_key = kks.replace('_',':')
        else:
            hash_key = kks+':V'
        user_data = {'value':999,'quality':0,'dcstime':' '}
        r.hset(hash_key,mapping=user_data)
    for item in No4Boilerlist:
        kks,comment = item
        if(kks.endswith('_FB',0,len(kks)-1)):
            hash_key = kks.replace('_',':')
        else:
            hash_key = kks+':V'
        user_data = {'value':999,'quality':0,'dcstime':' '}
        r.hset(hash_key,mapping=user_data)
    for item in Publiclist:
        kks,comment = item
        if(kks.endswith('_FB',0,len(kks)-1)):
            hash_key = kks.replace('_',':')
        else:
            hash_key = kks+':V'
        user_data = {'value':999,'quality':0,'dcstime':' '}
        r.hset(hash_key,mapping=user_data)
    for item in Turbinelist:
        kks,comment = item
        if(kks.endswith('_FB',0,len(kks)-1)):
            hash_key = kks.replace('_',':')
        else:
            hash_key = kks+':V'
        user_data = {'value':999,'quality':0,'dcstime':' '}
        r.hset(hash_key,mapping=user_data)
    for item in FGDlist:
        kks,comment = item
        if(kks.endswith('_FB',0,len(kks)-1)):
            hash_key = kks.replace('_',':')
        else:
            hash_key = kks+':V'
        user_data = {'value':999,'quality':0,'dcstime':' '}
        r.hset(hash_key,mapping=user_data)

    dicin = {}

    time= '11/23/24 16:12:05'
    value=0;
    qu=192
    dicin['00HTQ20AA201_FB1']=[value,qu,time]

    time= '11/23/24 16:12:05'
    value=1;
    qu=192
    dicin['00HTQ20AA201_FB0']=[value,qu,time]

    time= '11/23/24 16:12:05'
    value=99.3;
    qu=192
    dicin['0AA201_FB0']=[value,qu,time]

    #q.put(dicin)
    #q.put(dicin)
        
    print(dicin)
    #dic = q.get()
    for key,lis in dicin.items():
    #    update_data.append((key,lis[0],lis[1],datetime.strptime(lis[2],"%m/%d/%y %H:%M:%S")))
        kks = key 
        if(kks.endswith('_FB',0,len(kks)-1)):
            print("yes")
            kks_v = kks[0:-4]
            print(kks_v)
            hash_key = kks.replace('_',':')
            #hash_key = '10HAD10AA001:FB1'
            dcstime = str(datetime.strptime(lis[2],"%m/%d/%y %H:%M:%S"))
            user_data = {'value':lis[0],'quality':lis[1],'dcstime':dcstime}
            r.hset(hash_key,mapping=user_data)

            fb1 = r.hget(kks_v+':FB1','value')
            fb0 = r.hget(kks_v+':FB0','value')
            fb=int(fb1)<<1 | int(fb0)
            print(fb1)
            print(fb0)
            print(fb)

            hash_key = kks_v+':V'
            user_data = {'value':fb,'quality':192,'dcstime':dcstime}
            r.hset(hash_key,mapping=user_data)

except redis.exceptions.ConnectionError as e:
    print(f"无法创建Redis连接池或连接失败:{e}")
finally:
    pool.disconnect()
