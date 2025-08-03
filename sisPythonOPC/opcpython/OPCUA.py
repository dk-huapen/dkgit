# -*- coding: utf-8 -*-
#!/usr/bin/python
# 文件名:server.py
 
from tkinter import *
import tkinter as tk
import socket               # 导入 socket 模块
import json
import time
import pymysql
import threading
from datetime import datetime
import redis
import sys
sys.path.insert(0,"..")#ua
from opcua import Server
from varlist import No1Boilerlist,No2Boilerlist,No3Boilerlist,No4Boilerlist,Publiclist,Turbinelist,FGDlist,LUANlist,Auxiliarylist

import queue
import traceback

def CleanHistory():
    global No1Boilerlist
    global No2Boilerlist
    global No3Boilerlist
    global No4Boilerlist
    global Publiclist
    global Auxiliarylist
    global LUANlist
    global Turbinelist
    global FGDlist
    global qHistory
    global OPCUAFlag
    global HistoryBufSizeVar
    global HistoryQueueSizeVar

    db = pymysql.connect(user='root',password='P@ssw0rd',host = 'localhost',db='abbhistory')
    cursor = db.cursor()

    HistoryStatus.config(text="正在清空数据库")
    for item in No1Boilerlist:
        kks,comment = item
        sql_drop = "DROP TABLE IF EXISTS "+kks;
        cursor.execute(sql_drop)
    db.commit()
    for item in No2Boilerlist:
        kks,comment = item
        sql_drop = "DROP TABLE IF EXISTS "+kks;
        cursor.execute(sql_drop)
    db.commit()
    for item in No3Boilerlist:
        kks,comment = item
        sql_drop = "DROP TABLE IF EXISTS "+kks;
    db.commit()
    for item in No4Boilerlist:
        kks,comment = item
        sql_drop = "DROP TABLE IF EXISTS "+kks;
        cursor.execute(sql_drop)
    db.commit()
    for item in Turbinelist:
        kks,comment = item
        sql_drop = "DROP TABLE IF EXISTS "+kks;
        cursor.execute(sql_drop)
    db.commit()
    for item in Publiclist:
        kks,comment = item
        sql_drop = "DROP TABLE IF EXISTS "+kks;
        cursor.execute(sql_drop)
    db.commit()
    for item in Auxiliarylist:
        kks,comment = item
        sql_drop = "DROP TABLE IF EXISTS "+kks;
        cursor.execute(sql_drop)
    db.commit()
    for item in LUANlist:
        kks,comment = item
        sql_drop = "DROP TABLE IF EXISTS "+kks;
        cursor.execute(sql_drop)
    db.commit()
    for item in FGDlist:
        kks,comment = item
        sql_drop = "DROP TABLE IF EXISTS "+kks;
        cursor.execute(sql_drop)
    db.commit()

    HistoryStatus.config(text="数据库已清空")
    db.close()

def SISBuff(n):
    global No1Boilerlist
    global No2Boilerlist
    global No3Boilerlist
    global No4Boilerlist
    global Publiclist
    global LUANlist
    global Turbinelist
    global Auxiliarylist
    global FGDlist
    global qSISBuff
    global sisBuffFlag

    start = time.time()

    my_thread_name = threading.current_thread().name
    print('%s开始运行...' % my_thread_name)
    try:
        pool = redis.ConnectionPool(host='127.0.0.1',port=6379,db=1,decode_responses=True)

        r = redis.Redis(connection_pool=pool)
        response = r.ping()
        print(response)
    except redis.exceptions.ConnectionError as e:
        print(f"无法创建Redis连接池或连接失败:{e}")

    update_data = []
    kkslist = []
    for item in FGDlist:
        kks,comment = item
        kkslist.append(kks)
        hash_key = kks
        user_data = {'value':'0','quality':0,'updatetime':' '}
        r.hset(hash_key,mapping=user_data)
        if kks.endswith('GT'):
            hash_key = kks[0:-2] 
            user_data = {'value':'0','quality':0,'updatetime':' '}
            r.hset(hash_key,mapping=user_data)
        if kks.endswith('_FB',0,len(kks)-1):
            hash_key = kks[0:-4] 
            user_data = {'value':'0','quality':0,'updatetime':' '}
            r.hset(hash_key,mapping=user_data)
    for item in Turbinelist:
        kks,comment = item
        kkslist.append(kks)
        hash_key = kks
        user_data = {'value':'0','quality':0,'updatetime':' '}
        r.hset(hash_key,mapping=user_data)
        if kks.endswith('GT'):
            hash_key = kks[0:-2] 
            user_data = {'value':'0','quality':0,'updatetime':' '}
            r.hset(hash_key,mapping=user_data)
        if kks.endswith('_FB',0,len(kks)-1):
            hash_key = kks[0:-4] 
            user_data = {'value':'0','quality':0,'updatetime':' '}
            r.hset(hash_key,mapping=user_data)
    for item in LUANlist:
        kks,comment = item
        kkslist.append(kks)
        hash_key = kks
        user_data = {'value':'0','quality':0,'updatetime':' '}
        r.hset(hash_key,mapping=user_data)
        if kks.endswith('GT'):
            hash_key = kks[0:-2] 
            user_data = {'value':'0','quality':0,'updatetime':' '}
            r.hset(hash_key,mapping=user_data)
        if kks.endswith('_FB',0,len(kks)-1):
            hash_key = kks[0:-4] 
            user_data = {'value':'0','quality':0,'updatetime':' '}
            r.hset(hash_key,mapping=user_data)
    for item in Publiclist:
        kks,comment = item
        kkslist.append(kks)
        hash_key = kks
        user_data = {'value':'0','quality':0,'updatetime':' '}
        r.hset(hash_key,mapping=user_data)
        if kks.endswith('GT'):
            hash_key = kks[0:-2] 
            user_data = {'value':'0','quality':0,'updatetime':' '}
            r.hset(hash_key,mapping=user_data)
        if kks.endswith('_FB',0,len(kks)-1):
            hash_key = kks[0:-4] 
            user_data = {'value':'0','quality':0,'updatetime':' '}
            r.hset(hash_key,mapping=user_data)
    for item in Auxiliarylist:
        kks,comment = item
        kkslist.append(kks)
        hash_key = kks
        user_data = {'value':'0','quality':0,'updatetime':' '}
        r.hset(hash_key,mapping=user_data)
        if kks.endswith('GT'):
            hash_key = kks[0:-2] 
            user_data = {'value':'0','quality':0,'updatetime':' '}
            r.hset(hash_key,mapping=user_data)
        if kks.endswith('_FB',0,len(kks)-1):
            hash_key = kks[0:-4] 
            user_data = {'value':'0','quality':0,'updatetime':' '}
            r.hset(hash_key,mapping=user_data)
    for item in No1Boilerlist:
        kks,comment = item
        kkslist.append(kks)
        hash_key = kks
        user_data = {'value':'0','quality':0,'updatetime':' '}
        r.hset(hash_key,mapping=user_data)
        if kks.endswith('GT'):
            hash_key = kks[0:-2] 
            user_data = {'value':'0','quality':0,'updatetime':' '}
            r.hset(hash_key,mapping=user_data)
        if kks.endswith('_FB',0,len(kks)-1):
            hash_key = kks[0:-4] 
            user_data = {'value':'0','quality':0,'updatetime':' '}
            r.hset(hash_key,mapping=user_data)
    for item in No2Boilerlist:
        kks,comment = item
        kkslist.append(kks)
        hash_key = kks
        user_data = {'value':'0','quality':0,'updatetime':' '}
        r.hset(hash_key,mapping=user_data)
        if kks.endswith('GT'):
            hash_key = kks[0:-2] 
            user_data = {'value':'0','quality':0,'updatetime':' '}
            r.hset(hash_key,mapping=user_data)
        if kks.endswith('_FB',0,len(kks)-1):
            hash_key = kks[0:-4] 
            user_data = {'value':'0','quality':0,'updatetime':' '}
            r.hset(hash_key,mapping=user_data)
    for item in No3Boilerlist:
        kks,comment = item
        kkslist.append(kks)
        hash_key = kks
        user_data = {'value':'0','quality':0,'updatetime':' '}
        r.hset(hash_key,mapping=user_data)
        if kks.endswith('GT'):
            hash_key = kks[0:-2] 
            user_data = {'value':'0','quality':0,'updatetime':' '}
            r.hset(hash_key,mapping=user_data)
        if kks.endswith('_FB',0,len(kks)-1):
            hash_key = kks[0:-4] 
            user_data = {'value':'0','quality':0,'updatetime':' '}
            r.hset(hash_key,mapping=user_data)
    for item in No4Boilerlist:
        kks,comment = item
        kkslist.append(kks)
        hash_key = kks
        user_data = {'value':'0','quality':0,'updatetime':' '}
        r.hset(hash_key,mapping=user_data)
        if kks.endswith('GT'):
            hash_key = kks[0:-2] 
            user_data = {'value':'0','quality':0,'updatetime':' '}
            r.hset(hash_key,mapping=user_data)
        if kks.endswith('_FB',0,len(kks)-1):
            hash_key = kks[0:-4] 
            user_data = {'value':'0','quality':0,'updatetime':' '}
            r.hset(hash_key,mapping=user_data)

    #db = pymysql.connect(user='root',password='P@ssw0rd',host = 'localhost',db='opcuasis')
    db = pymysql.connect(user='opcuasis',password='opcuasis',host = '192.168.5.124',db='opcuasis')
    cursor = db.cursor()

    truncate_sql = "truncate table uadata"
    cursor.execute(truncate_sql)

    insert_query = "insert into uadata (kks) values (%s)"
    cursor.executemany(insert_query,kkslist)
    db.commit()
    sisBuffFlag = True 
    num = 0

    try:
        while (OPCUAFlag and sisBuffFlag):
            if not SISBuffEvent.is_set():
                SISBuffStatus.config(text="SIS缓存暂停")
            SISBuffEvent.wait()
            #print("SISBuff runing")

            #if not sisBuffFlag:
            #    break;
            try:
                dic = qSISBuff.get(timeout=5)
            except queue.Empty as e:
                continue
            for key,lis in dic.items():
                #update_data.append((key,lis[0],lis[1],datetime.strptime(lis[2],"%m/%d/%y %H:%M:%S")))
                hash_key = key 
                #value = str(lis[0]).split('.')[0]+'.'+str(lis[0]).split('.')[1][:2]
                value = str(round(lis[0],2))
                dcstime = str(datetime.strptime(lis[2],"%m/%d/%y %H:%M:%S"))
                user_data = {'value':value,'quality':lis[1],'updatetime':dcstime}
                r.hset(hash_key,mapping=user_data)
                if key.endswith('GT'):
                    hash_key = key[0:-2] 
                    if(float(value) > 98):
                        value = 2
                    elif(float(value) < 2):
                        value = 1
                    else:
                        value = 0
                    user_data = {'value':value,'quality':lis[1],'updatetime':dcstime}
                    r.hset(hash_key,mapping=user_data)
                if key.endswith('_FB',0,len(key)-1):
                    hash_key = key[0:-4] 
                    kks_v = key[0:-4]
                    fb1 = r.hget(kks_v+'_FB1','value')
                    fb0 = r.hget(kks_v+'_FB0','value')
                    try:
                        fb=int(fb1)<<1 | int(fb0)
                    except TypeError as e:
                        print(kks_v)
                        print(type(fb1))
                        print(type(fb0))

                    user_data = {'value':fb,'quality':lis[1],'updatetime':dcstime}
                    r.hset(hash_key,mapping=user_data)
                user_data.clear()

            #if num > 5:
                #update_query = "insert into uadata(kks,value,quality,dcstime) values(%s,%s,%s,%s) on duplicate key update kks=values(kks),value=values(value),quality=values(quality),dcstime=values(dcstime)"
                #cursor.executemany(update_query,update_data)
                #SISBuffStatus.config(text="更新点数量:"+str(len(update_data)))
                #update_data.clear()
                #db.commit()
                #update_query = "insert into uadata(value,quality,dcstime) values(%s,%s,%s) on duplicate key update value=values(value),quality=values(quality),dcstime=values(dcstime)"
                #num = 0
                #while not qSISBuff.empty():
                #    qSISBuff.get()
            #else:
            #    num = num + 1
            SISBufflabel.config(text=str(qSISBuff.qsize()))

    finally:
        pool.disconnect()
        db.close()
        SISBufflabel.config(text=str(qSISBuff.qsize()))
        sisBuffFlag = False
        SISBuffEvent.clear()
        while not qSISBuff.empty():
            qSISBuff.get()
        CreateSISBuffButton['state'] = NORMAL
        StartSISBuffButton['state'] = DISABLED
        StartSISBuffButton["text"] = "开始SIS缓存"

        StopSISBuffButton['state'] = DISABLED
        StopSISBuffButton["text"] = "SIS缓存已停止"
        print('%s运行结束，耗时%ds...' % (my_thread_name,time.time() - start))

def History(n):
    global No1Boilerlist
    global No2Boilerlist
    global No3Boilerlist
    global No4Boilerlist
    global Publiclist
    global LUANlist
    global Turbinelist
    global Auxiliarylist
    global FGDlist
    global qHistory
    global OPCUAFlag
    global HistoryBufSizeVar
    global HistoryQueueSizeVar
    global historyBuffFlag


    start = time.time()
    my_thread_name = threading.current_thread().name
    print('%s开始运行...' % my_thread_name)

    db = pymysql.connect(user='root',password='P@ssw0rd',host = 'localhost',db='abbhistory')
    cursor = db.cursor()
    HistoryStatus.config(text="数据库正在初始化")

    for item in No1Boilerlist:
        kks,comment = item
    #for key in BoilerVarlist.keys():
        sql_create = "CREATE TABLE IF NOT EXISTS "+kks+" (`id` int(11) NOT NULL AUTO_INCREMENT,`value` float DEFAULT NULL,`quality` int DEFAULT NULL,`time` datetime DEFAULT NULL,PRIMARY KEY (`id`),KEY `time` (`time`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='"+comment+"'";
        #print(sql_create)
        cursor.execute(sql_create)
    db.commit()
    for item in No2Boilerlist:
        kks,comment = item
    #for key in BoilerVarlist.keys():
        sql_create = "CREATE TABLE IF NOT EXISTS "+kks+" (`id` int(11) NOT NULL AUTO_INCREMENT,`value` float DEFAULT NULL,`quality` int DEFAULT NULL,`time` datetime DEFAULT NULL,PRIMARY KEY (`id`),KEY `time` (`time`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='"+comment+"'";
        #print(sql_create)
        cursor.execute(sql_create)
    db.commit()
    for item in No3Boilerlist:
        kks,comment = item
    #for key in BoilerVarlist.keys():
        sql_create = "CREATE TABLE IF NOT EXISTS "+kks+" (`id` int(11) NOT NULL AUTO_INCREMENT,`value` float DEFAULT NULL,`quality` int DEFAULT NULL,`time` datetime DEFAULT NULL,PRIMARY KEY (`id`),KEY `time` (`time`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='"+comment+"'";
        #print(sql_create)
        cursor.execute(sql_create)
    db.commit()
    for item in No4Boilerlist:
        kks,comment = item
    #for key in BoilerVarlist.keys():
        sql_create = "CREATE TABLE IF NOT EXISTS "+kks+" (`id` int(11) NOT NULL AUTO_INCREMENT,`value` float DEFAULT NULL,`quality` int DEFAULT NULL,`time` datetime DEFAULT NULL,PRIMARY KEY (`id`),KEY `time` (`time`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='"+comment+"'";
        #print(sql_create)
        cursor.execute(sql_create)
    db.commit()
    for item in Turbinelist:
        kks,comment = item
    #for key in BoilerVarlist.keys():
        sql_create = "CREATE TABLE IF NOT EXISTS "+kks+" (`id` int(11) NOT NULL AUTO_INCREMENT,`value` float DEFAULT NULL,`quality` int DEFAULT NULL,`time` datetime DEFAULT NULL,PRIMARY KEY (`id`),KEY `time` (`time`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='"+comment+"'";
        #print(sql_create)
        cursor.execute(sql_create)
    db.commit()
    for item in Publiclist:
        kks,comment = item
    #for key in PublicVarlist.keys():
        sql_create = "CREATE TABLE IF NOT EXISTS "+kks+" (`id` int(11) NOT NULL AUTO_INCREMENT,`value` float DEFAULT NULL,`quality` int DEFAULT NULL,`time` datetime DEFAULT NULL,PRIMARY KEY (`id`),KEY `time` (`time`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='"+comment+"'";
        cursor.execute(sql_create)
    db.commit()
    for item in Auxiliarylist:
        kks,comment = item
    #for key in PublicVarlist.keys():
        sql_create = "CREATE TABLE IF NOT EXISTS "+kks+" (`id` int(11) NOT NULL AUTO_INCREMENT,`value` float DEFAULT NULL,`quality` int DEFAULT NULL,`time` datetime DEFAULT NULL,PRIMARY KEY (`id`),KEY `time` (`time`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='"+comment+"'";
        cursor.execute(sql_create)
    db.commit()
    for item in LUANlist:
        kks,comment = item
    #for key in PublicVarlist.keys():
        sql_create = "CREATE TABLE IF NOT EXISTS "+kks+" (`id` int(11) NOT NULL AUTO_INCREMENT,`value` float DEFAULT NULL,`quality` int DEFAULT NULL,`time` datetime DEFAULT NULL,PRIMARY KEY (`id`),KEY `time` (`time`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='"+comment+"'";
        cursor.execute(sql_create)
    db.commit()
    for item in FGDlist:
        kks,comment = item
    #for key in PublicVarlist.keys():
        sql_create = "CREATE TABLE IF NOT EXISTS "+kks+" (`id` int(11) NOT NULL AUTO_INCREMENT,`value` float DEFAULT NULL,`quality` int DEFAULT NULL,`time` datetime DEFAULT NULL,PRIMARY KEY (`id`),KEY `time` (`time`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='"+comment+"'";
        cursor.execute(sql_create)
    db.commit()

    HistoryStatus.config(text="数据库初始化完成")
    try:
        print('%s正在运行...' % my_thread_name)
        num = 0
        row = 0
        historyBuffFlag = True
        #while True:
        #while OPCUAFlag:
        while (OPCUAFlag and historyBuffFlag):
            if not HistoryEvent.is_set():
                HistoryStatus.config(text="历史数据暂停存储")
            HistoryEvent.wait()
            try:
                dic = qHistory.get(timeout=5)
            except queue.Empty as e:
                continue
            #print(dic)
            for key,lis in dic.items():
                HistoryBuff[key].append((lis[0],lis[1],datetime.strptime(lis[2],"%m/%d/%y %H:%M:%S")))
            #if ((num > 10000) and historyBuffFlag):
            if num > 10000:
                for table,data in HistoryBuff.items():
                    sql = "insert into "+table+" (value,quality,time) values(%s,%s,%s)"
                    row = cursor.executemany(sql,data)
                    #print(row)
                    db.commit()
                    data.clear()
                    if not historyBuffFlag:
                        break
                num = 0
            else:
                num = num +1

                #sql = "insert into "+key+"(value,quality,time) values(%s,%s,%s)"
                #print(sql)
                #cursor.execute(sql,(lis[0],lis[1],datetime.strptime(lis[2],"%m/%d/%y %H:%M:%S")))
                #db.commit()
            #print(qHistory.qsize())
            HistoryBufflabel.config(text=num)
            HistoryBufSizeVar.set_value(num)
            HistorySqllabel.config(text=row)
            HistoryStatus.config(text="历史数据存储队列:"+str(qHistory.qsize()))
            HistoryQueueSizeVar.set_value(qHistory.qsize())
            #time.sleep(0.05)
    finally:
        historyBuffFlag = False
        HistoryEvent.clear()
        while not qHistory.empty():
            qHistory.get()
        CreateHistoryButton['state'] = NORMAL
        StartHistoryButton['state'] = DISABLED
        StartHistoryButton["text"] = "开始存储历史数据"

        StopHistoryButton['state'] = DISABLED
        StopHistoryButton["text"] = "停止存储历史数据"
        cursor.close()#释放数据库连接
        db.close()#释放数据库连接
        print('%s运行结束，耗时%ds...' % (my_thread_name,time.time() - start))

def Public(n):
    global PublicVarlist
    #global Publiclist
    global PublicDataSizeVar
    global qHistory
    global OPCUAFlag
    global sisBuffFlag

    s = socket.socket()         # 创建 socket 对象
    #host = socket.gethostname() # 获取本地主机名
    host = "172.16.2.1" # 获取本地主机名
    port = 2181                # 设置端口
    s.bind((host, port))        # 绑定端口
    s.listen(2)                 # 等待客户端连接
    PublicStatus.config(text="公用正在等待连接")
    TurbineNo1S,addr = s.accept()     # 建立客户端连接
    print('公用系统连接地址:', addr)

    start = time.time()
    my_thread_name = threading.current_thread().name
    print('%s开始运行...' % my_thread_name)
    try:
        print('%s正在运行...' % my_thread_name)
        #while True:
        while OPCUAFlag:
            if not PublicEvent.is_set():
                PublicStatus.config(text="公用暂停接收数据")
            PublicEvent.wait()
            length_bytes = TurbineNo1S.recv(4)
            length = int.from_bytes(length_bytes,byteorder='big')
            data = b''
            while len(data) < length:
                data += TurbineNo1S.recv(length - len(data))
            #data = BoilerNo1S.recv(1024)
            if len(data) == 0:
                pass
            else:
                dataSize = len(data)
                PublicStatus.config(text="公用接收数据大小:"+str(len(data)))
                PublicDataSizeVar.set_value(dataSize)
                #print(data)
                dic = json.loads(data)
                for key in dic:
                    if(dic[key][0] < -1000):
                        dic[key][0] = -999
                    PublicVarlist[key].set_value(dic[key][0])
                qHistory.put(dic)
                if sisBuffFlag:
                    qSISBuff.put(dic)
    finally:
        #TurbineNo1S.close()                # 关闭连接
        print("Public over!")
        if(s):
            s.close()
        print('%s运行结束，耗时%ds...' % (my_thread_name,time.time() - start))

def FGD(n):
    global FGDVarlist
    #global Publiclist
    global qHistory
    global OPCUAFlag
    global FGDDataSizeVar
    global sisBuffFlag

    s = socket.socket()         # 创建 socket 对象
    #host = socket.gethostname() # 获取本地主机名
    host = "172.16.3.1" # 获取本地主机名
    port = 9090                # 设置端口
    s.bind((host, port))        # 绑定端口
    s.listen(2)                 # 等待客户端连接
    FGDStatus.config(text="脱硫正在等待连接")
    FGDS,addr = s.accept()     # 建立客户端连接
    print('脱硫系统连接地址:', addr)

    start = time.time()
    my_thread_name = threading.current_thread().name
    print('%s开始运行...' % my_thread_name)
    try:
        print('%s正在运行...' % my_thread_name)
        #while True:
        while OPCUAFlag:
            if not FGDEvent.is_set():
                FGDStatus.config(text="脱硫暂停接收数据")
            FGDEvent.wait()
            length_bytes = FGDS.recv(4)
            length = int.from_bytes(length_bytes,byteorder='big')
            data = b''
            while len(data) < length:
                data += FGDS.recv(length - len(data))
            #data = BoilerNo1S.recv(1024)
            if len(data) == 0:
                pass
            else:
                dataSize = len(data)
                FGDStatus.config(text="脱硫接收数据大小:"+str(len(data)))
                FGDDataSizeVar.set_value(dataSize)
                #print(data)
                dic = json.loads(data)
                try:
                    for key in dic:
                        if(dic[key][0] < -1000):
                            dic[key][0] = -999
                        FGDVarlist[key].set_value(dic[key][0])
                except KeyError:
                    info = traceback.format_exc()
                    print(info)
                else:
                    qHistory.put(dic)
                    if sisBuffFlag:
                        qSISBuff.put(dic)
                    #qSISBuff.put(dic)
                    #print(dic)
    finally:
        print("FGD over!")
        #if(FGDS):
        #    FGDS.close()                # 关闭连接
        if(s):
            s.close()
        print('%s运行结束，耗时%ds...' % (my_thread_name,time.time() - start))

def BoilerNo1(n):
    global BoilerVarlist
    #global Boilerlist
    global qHistory
    global OPCUAFlag
    global sisBuffFlag

    s = socket.socket()         # 创建 socket 对象
    #host = socket.gethostname() # 获取本地主机名
    host = "172.16.2.1" # 获取本地主机名
    port = 8899                # 设置端口
    s.bind((host, port))        # 绑定端口
 
    s.listen(5)                 # 等待客户端连接
    BoilerStatus.config(text="锅炉正在等待连接")
    BoilerNo1S,addr = s.accept()     # 建立客户端连接
    print('锅炉连接地址:', addr)

    start = time.time()
    my_thread_name = threading.current_thread().name
    print('%s开始运行...' % my_thread_name)
    try:
        print('%s正在运行...' % my_thread_name)
        #data = BoilerNo1S.recv(1024)
        #print(data)
        #while True:
        while OPCUAFlag:
            if not BoilerEvent.is_set():
                BoilerStatus.config(text="锅炉暂停接收数据")
            BoilerEvent.wait()
            length_bytes = BoilerNo1S.recv(4)
            length = int.from_bytes(length_bytes,byteorder='big')
            data = b''
            while len(data) < length:
                data += BoilerNo1S.recv(length - len(data))
            #data = BoilerNo1S.recv(1024)
            if len(data) == 0:
                pass
            else:
                #print(data)
                dataSize = len(data)
                BoilerStatus.config(text="锅炉接收数据大小:"+str(len(data)))
                BoilerDataSizeVar.set_value(dataSize)
                dic = json.loads(data)
                for key in dic:
                    if(dic[key][0] < -1000):
                        dic[key][0] = -999
                    BoilerVarlist[key].set_value(dic[key][0])
                qHistory.put(dic)
                if sisBuffFlag:
                    qSISBuff.put(dic)

            #print('1号炉数据%s' % dic['10HAH30CT221'])
                #for y in Boilerlist:
                    #BoilerVarlist[y].set_value(dic[y][0])
    finally:
        #BoilerNo1S.close()                # 关闭连接
        print("Boiler over!")
        if(s):
            s.close()
        print('%s运行结束，耗时%ds...' % (my_thread_name,time.time() - start))

def StartOPCUA():
    global server
    global OPCUAFlag
    server.start()#启动UA服务端
    OPCUAFlag = True
    UAStatus.config(text="OPC UA服务器已启动")
    StartOPCUAButton['state'] = DISABLED
    StartOPCUAButton["text"] = "OPCUA服务器已启动"
    StopOPCUAButton['state'] = NORMAL
    StopOPCUAButton["text"] = "停止OPCUA服务器"
    CreateBoilerButton['state'] = NORMAL
    CreatePublicButton['state'] = NORMAL
    CreateFGDButton['state'] = NORMAL
    CreateHistoryButton['state'] = NORMAL
    CreateSISBuffButton['state'] = NORMAL
    autoStartButton['state'] = NORMAL

def StopOPCUA():
    global server
    global OPCUAFlag

    OPCUAFlag = False
    server.stop()#停止UA服务端
    StartOPCUAButton['state'] = NORMAL
    StartOPCUAButton["text"] = "启动OPCUA服务器"

    StopOPCUAButton['state'] = DISABLED
    StopOPCUAButton["text"] = "OPCUA服务器已停止"
    UAStatus.config(text="OPC UA服务器已停止")
def autoStart():
    CreateBoiler()
    StartBoiler()
    CreatePublic()
    StartPublic()
    CreateFGD()
    StartFGD()
    CreateHistory()
    StartHistory()

def CreateFGD():
    t2 = threading.Thread(target=FGD,name='脱硫系统线程',args=(2,))
    t2.daemon = True
    t2.start()
    CreateFGDButton['state'] = DISABLED
    CreateFGDButton["text"] = "已创建脱硫线程"
    StartFGDButton['state'] = NORMAL

def StartFGD():
    FGDEvent.set()
    StartFGDButton['state'] = DISABLED
    StartFGDButton["text"] = "正在接收脱硫数据"
    StopFGDButton['state'] = NORMAL
    StopFGDButton["text"] = "停止接收脱硫数据"


def StopFGD():
    FGDEvent.clear()
    StartFGDButton['state'] = NORMAL
    StartFGDButton["text"] = "开始接收脱硫数据"

    StopFGDButton['state'] = DISABLED
    StopFGDButton["text"] = "暂停接收脱硫数据"


def CreateBoiler():
    t = threading.Thread(target=BoilerNo1,name='锅炉线程',args=(2,))
    t.daemon = True
    t.start()
    CreateBoilerButton['state'] = DISABLED
    CreateBoilerButton["text"] = "已创建锅炉线程"
    StartBoilerButton['state'] = NORMAL

def StartBoiler():
    BoilerEvent.set()
    StartBoilerButton['state'] = DISABLED
    StartBoilerButton["text"] = "正在接收锅炉数据"
    StopBoilerButton['state'] = NORMAL
    StopBoilerButton["text"] = "停止接收锅炉数据"


def StopBoiler():
    BoilerEvent.clear()
    StartBoilerButton['state'] = NORMAL
    StartBoilerButton["text"] = "开始接收锅炉数据"

    StopBoilerButton['state'] = DISABLED
    StopBoilerButton["text"] = "暂停接收锅炉数据"

def CreatePublic():
    t1 = threading.Thread(target=Public,name='公用系统线程',args=(2,))
    t1.daemon = True
    t1.start()
    CreatePublicButton['state'] = DISABLED
    CreatePublicButton["text"] = "已创建公用系统线程"
    StartPublicButton['state'] = NORMAL

def StartPublic():
    PublicEvent.set()
    StartPublicButton['state'] = DISABLED
    StartPublicButton["text"] = "正在接收公用系统数据"
    StopPublicButton['state'] = NORMAL
    StopPublicButton["text"] = "停止接收公用系统数据"


def StopPublic():
    PublicEvent.clear()
    StartPublicButton['state'] = NORMAL
    StartPublicButton["text"] = "开始接收公用系统数据"

    StopPublicButton['state'] = DISABLED
    StopPublicButton["text"] = "暂停接收公用系统数据"
def CreateHistory():
    t = threading.Thread(target=History,name='历史数据',args=(2,))
    t.daemon = True
    t.start()
    CreateHistoryButton['state'] = DISABLED
    CreateHistoryButton["text"] = "已创建历史数据线程"
    StartHistoryButton['state'] = NORMAL
    FinishHistoryBuffButton['state'] = NORMAL

def StartHistory():
    HistoryEvent.set()
    StartHistoryButton['state'] = DISABLED
    StartHistoryButton["text"] = "正在存储历史数据"
    StopHistoryButton['state'] = NORMAL
    StopHistoryButton["text"] = "停止存储历史数据"
def CreateSISBuff():
    t = threading.Thread(target=SISBuff,name='SIS缓存',args=(2,))
    t.daemon = True
    t.start()
    CreateSISBuffButton['state'] = DISABLED
    CreateSISBuffButton["text"] = "已创建SIS缓存线程"
    StartSISBuffButton['state'] = NORMAL
    FinishSISBuffButton['state'] = NORMAL

def StartSISBuff():
    SISBuffEvent.set()
    StartSISBuffButton['state'] = DISABLED
    StartSISBuffButton["text"] = "SIS缓存正在运行"
    StopSISBuffButton['state'] = NORMAL
    StopSISBuffButton["text"] = "停止SIS缓存"
    SISBuffStatus.config(text="SIS缓存运行")

def StopSISBuff():
    SISBuffEvent.clear()
    StartSISBuffButton['state'] = NORMAL
    StartSISBuffButton["text"] = "开始SIS缓存"

    StopSISBuffButton['state'] = DISABLED
    StopSISBuffButton["text"] = "SIS缓存已停止"
def FinishSISBuff():
    global sisBuffFlag
    sisBuffFlag = False
    if not SISBuffEvent.is_set():
        SISBuffEvent.set()
def FinishHistoryBuff():
    global historyBuffFlag
    historyBuffFlag = False
    if not HistoryEvent.is_set():
        HistoryEvent.set()
    CleanHistoryButton['state'] = NORMAL


def StopHistory():
    HistoryEvent.clear()
    StartHistoryButton['state'] = NORMAL
    StartHistoryButton["text"] = "开始存储历史数据"

    StopHistoryButton['state'] = DISABLED
    StopHistoryButton["text"] = "暂停存储历史数据"

try:
    No1Boilerlist = No1Boilerlist.values()
    No2Boilerlist = No2Boilerlist.values()
    No3Boilerlist = No3Boilerlist.values()
    No4Boilerlist = No4Boilerlist.values()
    Publiclist = Publiclist.values()
    Turbinelist = Turbinelist.values()
    Auxiliarylist = Auxiliarylist.values()
    LUANlist = LUANlist.values()
    FGDlist = FGDlist.values()
    BoilerVarlist = {}
    PublicVarlist = {}
    FGDVarlist = {}
    SISVarlist = {}

    BoilerEvent = threading.Event()
    PublicEvent = threading.Event()
    FGDEvent = threading.Event()
    HistoryEvent = threading.Event()
    SISBuffEvent = threading.Event()
    historyBuffFlag = False
    sisBuffFlag = False
    HistoryBuff = {}
    OPCUAFlag = False
    qHistory = queue.Queue()
    qSISBuff = queue.Queue()

    #创建UA服务端
    server = Server()
    server.set_endpoint("opc.tcp://192.168.2.20:4845/freeopcua/SISserver/")
    uri = "http://automan.freeopcua.github.io"
    idx = server.register_namespace(uri)
    objects = server.get_objects_node()
    #创建根节点
    myobj = objects.add_object(idx, "ABB_DCS_OPC")
    #初始化LUAN节点
    LUANVar = myobj.add_object(idx, "LUAN")
    for item in LUANlist:
        kks,comment = item
        PublicVarlist[kks] = LUANVar.add_variable(idx,kks,999)
        HistoryBuff[kks] = []
    #初始化公用节点
    PublicVar = myobj.add_object(idx, "Turbine")
    for item in Publiclist:
        kks,comment = item
        PublicVarlist[kks] = PublicVar.add_variable(idx,kks,999)
        HistoryBuff[kks] = []
    #初始化汽轮机节点
    TurbineVar = myobj.add_object(idx, "Turbine12345")
    for item in Turbinelist:
        kks,comment = item
        PublicVarlist[kks] = TurbineVar.add_variable(idx,kks,999)
        HistoryBuff[kks] = []
    #初始化辅系统节点
    AuxiliaryVar = myobj.add_object(idx, "Auxiliary")
    for item in Auxiliarylist:
        kks,comment = item
        PublicVarlist[kks] = AuxiliaryVar.add_variable(idx,kks,999)
        HistoryBuff[kks] = []
    #初始化1号锅炉节点
    No1BoilerVar = myobj.add_object(idx, "Boiler")
    for item in No1Boilerlist:
        kks,comment = item
        BoilerVarlist[kks] = No1BoilerVar.add_variable(idx,kks,999)
        HistoryBuff[kks] = []
    #初始化2号锅炉节点
    No2BoilerVar = myobj.add_object(idx, "No2Boiler")
    for item in No2Boilerlist:
        kks,comment = item
        BoilerVarlist[kks] = No2BoilerVar.add_variable(idx,kks,999)
        HistoryBuff[kks] = []
    #初始化3号锅炉节点
    No3BoilerVar = myobj.add_object(idx, "No3Boiler")
    for item in No3Boilerlist:
        kks,comment = item
        BoilerVarlist[kks] = No3BoilerVar.add_variable(idx,kks,999)
        HistoryBuff[kks] = []
    #初始化4号锅炉节点
    No4BoilerVar = myobj.add_object(idx, "No4Boiler")
    for item in No4Boilerlist:
        kks,comment = item
        BoilerVarlist[kks] = No4BoilerVar.add_variable(idx,kks,999)
        HistoryBuff[kks] = []
    #初始化脱硫节点
    FGDVar = myobj.add_object(idx, "FGD")
    for item in FGDlist:
        kks,comment = item
        FGDVarlist[kks] = FGDVar.add_variable(idx,kks,999)
        HistoryBuff[kks] = []
    #初始化SIS系统状态节点
    SISVar = myobj.add_object(idx, "SISState")
    BoilerDataSizeVar= SISVar.add_variable(idx,"BoilerDataSize",999)
    PublicDataSizeVar= SISVar.add_variable(idx,"PublicDataSize",999)
    FGDDataSizeVar= SISVar.add_variable(idx,"FGDDataSize",999)
    HistoryBufSizeVar= SISVar.add_variable(idx,"HistoryBufSize",999)
    HistoryQueueSizeVar= SISVar.add_variable(idx,"HistoryQueueSize",999)
    SISSizeVar= SISVar.add_variable(idx,"SISBufSize",999)
    SISQueueSizeVar= SISVar.add_variable(idx,"SISQueueSize",999)

    root = tk.Tk()
    root.title("OPC UA服务器")
    root.geometry('800x500')

    locationX = 10
    locationY = 100

    OPCUATime = datetime.now()

    #OPCUAStartTime = Label(root,text='2025-05-05 12:52:33',width=30)
    OPCUAStartTimeL = Label(root,text="系统启动时间：",width=30)
    OPCUAStartTimeL.place(x=locationX,y=locationY-30)
    OPCUAStartTime = Label(root,text=OPCUATime,width=30)
    OPCUAStartTime.place(x=locationX+150,y=locationY-30)

    StartOPCUAButton = tk.Button(root,text='启动OPCUA服务器',width=20,command=StartOPCUA)
    StartOPCUAButton.place(x=locationX+5,y=locationY+5)

    StopOPCUAButton = Button(root,text='OPCUA服务器已停止',state=DISABLED,width=19,command=StopOPCUA)
    StopOPCUAButton.place(x=locationX+170,y=locationY+5)

    autoStartButton = Button(root,text='一键自动启动',state=DISABLED,width=19,command=autoStart)
    autoStartButton.place(x=locationX+340,y=locationY+5)

    UAStatus = Label(root,text='未OPC UA启动',width=20)
    UAStatus.place(x=locationX+520,y=locationY+5)

    CreateBoilerButton = tk.Button(root,text='创建锅炉线程',state=DISABLED,width=20,command=CreateBoiler)
    CreateBoilerButton.place(x=locationX+5,y=locationY+50)

    StartBoilerButton = tk.Button(root,text='开始接收锅炉数据',state=DISABLED,width=20,command=StartBoiler)
    StartBoilerButton.place(x=locationX+170,y=locationY+50)

    StopBoilerButton = Button(root,text='停止接收锅炉数据',state=DISABLED,width=19,command=StopBoiler)
    StopBoilerButton.place(x=locationX+340,y=locationY+50)

    BoilerStatus = Label(root,text='锅炉线程未启动',width=20)
    BoilerStatus.place(x=locationX+520,y=locationY+50)


    CreateFGDButton = tk.Button(root,text='创建脱硫线程',state=DISABLED,width=20,command=CreateFGD)
    CreateFGDButton.place(x=locationX+5,y=locationY+100)

    StartFGDButton = tk.Button(root,text='开始接收脱硫数据',state=DISABLED,width=20,command=StartFGD)
    StartFGDButton.place(x=locationX+170,y=locationY+100)

    StopFGDButton = Button(root,text='停止接收脱硫数据',state=DISABLED,width=19,command=StopFGD)
    StopFGDButton.place(x=locationX+340,y=locationY+100)

    FGDStatus = Label(root,text='脱硫线程未启动',width=20)
    FGDStatus.place(x=locationX+520,y=locationY+100)

    CreatePublicButton = tk.Button(root,text='创建公用系统线程',state=DISABLED,width=20,command=CreatePublic)
    CreatePublicButton.place(x=locationX+5,y=locationY+150)

    StartPublicButton = tk.Button(root,text='开始接收公用系统数据',state=DISABLED,width=20,command=StartPublic)
    StartPublicButton.place(x=locationX+170,y=locationY+150)

    StopPublicButton = Button(root,text='停止接收公用系统数据',state=DISABLED,width=19,command=StopPublic)
    StopPublicButton.place(x=locationX+340,y=locationY+150)

    PublicStatus = Label(root,text='公用线程未启动',width=20)
    PublicStatus.place(x=locationX+520,y=locationY+150)

    CreateHistoryButton = tk.Button(root,text='创建历史数据线程',state=DISABLED,width=20,command=CreateHistory)
    CreateHistoryButton.place(x=locationX+5,y=locationY+200)

    StartHistoryButton = tk.Button(root,text='开始存储历史数据',state=DISABLED,width=20,command=StartHistory)
    StartHistoryButton.place(x=locationX+170,y=locationY+200)

    StopHistoryButton = Button(root,text='停止存储历史数据',state=DISABLED,width=19,command=StopHistory)
    StopHistoryButton.place(x=locationX+340,y=locationY+200)


    HistoryStatus = Label(root,text='历史数据采集未启动',width=20)
    HistoryStatus.place(x=locationX+500,y=locationY+200)

    HistoryBufflabel = Label(root,text='缓冲',width=10)
    HistoryBufflabel.place(x=locationX+640,y=locationY+200)

    HistorySqllabel = Label(root,text='影响',width=10)
    HistorySqllabel.place(x=locationX+690,y=locationY+200)


    CreateSISBuffButton = tk.Button(root,text='创建SIS缓存线程',width=20,state=DISABLED,command=CreateSISBuff)
    CreateSISBuffButton.place(x=locationX+5,y=locationY+250)

    StartSISBuffButton = tk.Button(root,text='开始SIS数据更新',state=DISABLED,width=20,command=StartSISBuff)
    StartSISBuffButton.place(x=locationX+170,y=locationY+250)

    StopSISBuffButton = Button(root,text='停止SIS数据更新',state=DISABLED,width=19,command=StopSISBuff)
    StopSISBuffButton.place(x=locationX+340,y=locationY+250)

    CleanHistoryButton = Button(root,text='清空历史数据',state=DISABLED,width=19,command=CleanHistory)
    CleanHistoryButton.place(x=locationX+5,y=locationY+300)

    FinishSISBuffButton = Button(root,text='结束SIS数据更新',state=DISABLED,width=19,command=FinishSISBuff)
    FinishSISBuffButton.place(x=locationX+340,y=locationY+300)

    FinishHistoryBuffButton = Button(root,text='结束历史存储数据',state=DISABLED,width=19,command=FinishHistoryBuff)
    FinishHistoryBuffButton.place(x=locationX+170,y=locationY+300)

    SISBuffStatus = Label(root,text='SIS缓存未启动',width=20)
    SISBuffStatus.place(x=locationX+500,y=locationY+250)

    SISBufflabel = Label(root,text='缓冲',width=15)
    SISBufflabel.place(x=locationX+640,y=locationY+250)

    SISSqllabel = Label(root,text='影响',width=15)
    SISSqllabel.place(x=locationX+710,y=locationY+250)


    root.mainloop()
finally:
    #cursor.close()#释放数据库连接
    #db.close()#释放数据库连接
    print("it is over!")
 
