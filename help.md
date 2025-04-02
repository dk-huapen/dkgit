# 目录结构
## index.html  登录页面
## shell   shell自动运行脚本
- diary.sh    保存当天日志至指定文件夹下并发送邮件至指定邮箱
- myslq_backup.sh 备份数据库内容至指定文件夹下并删除7日前数据库备份
- crontable  linux系统cront服务定期执行任务配置文件
## first.php  平台登陆首页介绍平台各功能模块
## info.php  平台测试PHP输出PHP各加载模块页面
## phpmyadmin  MariaDB数据库可视化管理工具phpmyadmin
## .gitignore  git分布式版本控制系统忽略跟踪指定文件的配置文件
## sis  SIS系统文件目录
- conn.php  SIS系统数据库连接文件
- historySql.php SIS系统各设备操作面板二维码生成
- mian.php  SIS系统首页
- 
## sidebar  侧边栏模块
- ShowQRCode.php  生成并显示当前页面二维码
- quick_index.php  快速搜索栏，不论在任何页面可以直接搜索对应记录
- news.php  开发者关于项目相关消息发布栏
- notice.php  用户信息发布栏
- out_news.php  用户发布信息后服务器端信息处理脚本
