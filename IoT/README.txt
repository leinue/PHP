1.进入IoT/mysql/config.php修改数据库用户名和密码
2.在数据库后台创建一个名为ncu的数据库
3.运行IoT/mysql/mysql.php,此文件用来创建数据库表,仅需使用一次,使用完毕可以删除
4.socket_client.php为测试文件,不用管
5.socket包的格式为:
      latitude1,longitude1;latitude2,longitude3;[...,...];latitudeN,longitudeN;
      后面务必加分号!