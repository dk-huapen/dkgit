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
import sys
sys.path.insert(0,"..")#ua
from opcua import Server
#from FGDvar import FGDlist
#from Boilervar import Boilerlist
#from No3Boilervar import No3Boilerlist
#from Publicvar import Publiclist
from varlist import No1Boilerlist,No2Boilerlist,No3Boilerlist,No4Boilerlist,Publiclist,Turbinelist,FGDlist

import queue
import traceback

def History(n):
    global No1Boilerlist
    global No2Boilerlist
    global No3Boilerlist
    global No4Boilerlist
    global Publiclist
    global Turbinelist
    global FGDlist
    global qHistory
    global OPCUAFlag
    global HistoryBufSizeVar
    global HistoryQueueSizeVar

    start = time.time()
    my_thread_name = threading.current_thread().name
    print('%s开始运行...' % my_thread_name)

    db = pymysql.connect(user='root',password='P@ssw0rd',host = 'localhost',db='abbhistory')
    cursor = db.cursor()

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
        #while True:
        while OPCUAFlag:
            if not HistoryEvent.is_set():
                HistoryStatus.config(text="历史数据暂停存储")
            HistoryEvent.wait()
            dic = qHistory.get()
            #print(dic)
            for key,lis in dic.items():
                HistoryBuff[key].append((lis[0],lis[1],datetime.strptime(lis[2],"%m/%d/%y %H:%M:%S")))
            if num > 1000:
                for table,data in HistoryBuff.items():
                    sql = "insert into "+table+" (value,quality,time) values(%s,%s,%s)"
                    row = cursor.executemany(sql,data)
                    print(row)
                    db.commit()
                    data.clear()
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
        cursor.close()#释放数据库连接
        db.close()#释放数据库连接
        print('%s运行结束，耗时%ds...' % (my_thread_name,time.time() - start))

def Public(n):
    global PublicVarlist
    #global Publiclist
    global PublicDataSizeVar
    global qHistory
    global OPCUAFlag

    s = socket.socket()         # 创建 socket 对象
    host = socket.gethostname() # 获取本地主机名
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
                    PublicVarlist[key].set_value(dic[key][0])
                qHistory.put(dic)
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
                        FGDVarlist[key].set_value(dic[key][0])
                except KeyError:
                    info = traceback.format_exc()
                    print(info)
                else:
                    qHistory.put(dic)
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

    s = socket.socket()         # 创建 socket 对象
    host = socket.gethostname() # 获取本地主机名
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
                    BoilerVarlist[key].set_value(dic[key][0])
                qHistory.put(dic)

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

def StartHistory():
    HistoryEvent.set()
    StartHistoryButton['state'] = DISABLED
    StartHistoryButton["text"] = "正在存储历史数据"
    StopHistoryButton['state'] = NORMAL
    StopHistoryButton["text"] = "停止存储历史数据"


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
    FGDlist = FGDlist.values()
    BoilerVarlist = {}
    PublicVarlist = {}
    FGDVarlist = {}
    SISVarlist = {}
    BoilerEvent = threading.Event()
    PublicEvent = threading.Event()
    FGDEvent = threading.Event()
    HistoryEvent = threading.Event()
    HistoryBuff = {}
    OPCUAFlag = False
    qHistory = queue.Queue()

    #创建UA服务端
    server = Server()
    server.set_endpoint("opc.tcp://192.168.2.20:4845/freeopcua/SISserver/")
    uri = "http://automan.freeopcua.github.io"
    idx = server.register_namespace(uri)
    objects = server.get_objects_node()
    #创建根节点
    myobj = objects.add_object(idx, "ABB_DCS_OPC")
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

    root = tk.Tk()
    root.title("OPC UA")
    root.geometry('800x500')

    StartOPCUAButton = tk.Button(root,text='启动OPCUA服务器',width=20,command=StartOPCUA)
    StartOPCUAButton.place(x=5,y=5)

    StopOPCUAButton = Button(root,text='OPCUA服务器已停止',state=DISABLED,width=19,command=StopOPCUA)
    StopOPCUAButton.place(x=170,y=5)

    autoStartButton = Button(root,text='一键自动启动',state=DISABLED,width=19,command=autoStart)
    autoStartButton.place(x=340,y=5)

    UAStatus = Label(root,text='未OPC UA启动',width=20)
    UAStatus.place(x=520,y=5)

    CreateBoilerButton = tk.Button(root,text='创建锅炉线程',state=DISABLED,width=20,command=CreateBoiler)
    CreateBoilerButton.place(x=5,y=50)

    StartBoilerButton = tk.Button(root,text='开始接收锅炉数据',state=DISABLED,width=20,command=StartBoiler)
    StartBoilerButton.place(x=170,y=50)

    StopBoilerButton = Button(root,text='停止接收锅炉数据',state=DISABLED,width=19,command=StopBoiler)
    StopBoilerButton.place(x=340,y=50)

    BoilerStatus = Label(root,text='锅炉线程未启动',width=20)
    BoilerStatus.place(x=520,y=50)


    CreateFGDButton = tk.Button(root,text='创建脱硫线程',state=DISABLED,width=20,command=CreateFGD)
    CreateFGDButton.place(x=5,y=100)

    StartFGDButton = tk.Button(root,text='开始接收脱硫数据',state=DISABLED,width=20,command=StartFGD)
    StartFGDButton.place(x=170,y=100)

    StopFGDButton = Button(root,text='停止接收脱硫数据',state=DISABLED,width=19,command=StopFGD)
    StopFGDButton.place(x=340,y=100)

    FGDStatus = Label(root,text='脱硫线程未启动',width=20)
    FGDStatus.place(x=520,y=100)

    CreatePublicButton = tk.Button(root,text='创建公用系统线程',state=DISABLED,width=20,command=CreatePublic)
    CreatePublicButton.place(x=5,y=150)

    StartPublicButton = tk.Button(root,text='开始接收公用系统数据',state=DISABLED,width=20,command=StartPublic)
    StartPublicButton.place(x=170,y=150)

    StopPublicButton = Button(root,text='停止接收公用系统数据',state=DISABLED,width=19,command=StopPublic)
    StopPublicButton.place(x=340,y=150)

    PublicStatus = Label(root,text='公用线程未启动',width=20)
    PublicStatus.place(x=520,y=150)

    CreateHistoryButton = tk.Button(root,text='创建历史数据线程',state=DISABLED,width=20,command=CreateHistory)
    CreateHistoryButton.place(x=5,y=200)

    StartHistoryButton = tk.Button(root,text='开始存储历史数据',state=DISABLED,width=20,command=StartHistory)
    StartHistoryButton.place(x=170,y=200)

    StopHistoryButton = Button(root,text='开始存储历史数据',state=DISABLED,width=19,command=StopHistory)
    StopHistoryButton.place(x=340,y=200)

    HistoryStatus = Label(root,text='历史数据采集未启动',width=20)
    HistoryStatus.place(x=500,y=200)

    HistoryBufflabel = Label(root,text='缓冲',width=10)
    HistoryBufflabel.place(x=640,y=200)

    HistorySqllabel = Label(root,text='影响',width=10)
    HistorySqllabel.place(x=690,y=200)
    root.mainloop()
finally:
    #cursor.close()#释放数据库连接
    #db.close()#释放数据库连接
    print("it is over!")
 
