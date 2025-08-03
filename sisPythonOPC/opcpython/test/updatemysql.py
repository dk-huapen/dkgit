# -*- coding: cp936 -*-
#!/usr/bin/python
# 文件名:server.py
 
import time
import pymysql
from datetime import datetime
import queue
from varlist import No1Boilerlist,No2Boilerlist,No3Boilerlist,No4Boilerlist,Publiclist,Turbinelist,FGDlist
 
No1Boilerlist = No1Boilerlist.values()
No2Boilerlist = No2Boilerlist.values()
No3Boilerlist = No3Boilerlist.values()
No4Boilerlist = No4Boilerlist.values()
Publiclist = Publiclist.values()
Turbinelist = Turbinelist.values()
FGDlist = FGDlist.values()

kkslist = []
for item in FGDlist:
    kks,comment = item
    kkslist.append(kks)
for item in Turbinelist:
    kks,comment = item
    kkslist.append(kks)
for item in Publiclist:
    kks,comment = item
    kkslist.append(kks)
for item in No1Boilerlist:
    kks,comment = item
    kkslist.append(kks)
for item in No2Boilerlist:
    kks,comment = item
    kkslist.append(kks)
for item in No3Boilerlist:
    kks,comment = item
    kkslist.append(kks)
for item in No4Boilerlist:
    kks,comment = item
    kkslist.append(kks)

q = queue.Queue()
dicin = {}
#db = pymysql.connect(user='root',password='P@ssw0rd',host = 'localhost',db='opcuasis')
#db = pymysql.connect(user='opcuasis',password='opcuasis',host = '192.168.2.124',db='opcuasis')
#cursor = db.cursor()

#truncate_sql = "truncate table uadata"
#cursor.execute(truncate_sql)

#kkslist = ('10HTA10CQ001','10HTA10CQ003')
#insert_query = "insert into uadata (kks) values (%s)"
#cursor.executemany(insert_query,kkslist)
#db.commit()

time= '11/23/24 16:12:05'
value=8.4;
qu=192
dicin['10HTA10CQ001']=[value,qu,time]

time= '11/23/24 16:15:05'
value=6.1;
qu=192
dicin['10HTA10CQ003']=[value,qu,time]

q.put(dicin)
q.put(dicin)
q.put(dicin)
print(q.qsize())
q.clear()
print(q.qsize())

dic = q.get()

#update_data = []
#for key,lis in dic.items():
#    update_data.append((key,lis[0],lis[1],datetime.strptime(lis[2],"%m/%d/%y %H:%M:%S")))
#print(update_data)
##update_query = "update uadata set value = %s,quality=%s,dcstime=%s where kks = %s"
#update_query = "insert into uadata(kks,value,quality,dcstime) values(%s,%s,%s,%s) on duplicate key update kks=values(kks),value=values(value),quality=values(quality),dcstime=values(dcstime)"
#cursor.executemany(update_query,update_data)
#db.commit()

#db.close()
