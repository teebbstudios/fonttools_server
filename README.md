# fonttools_server
用于名片编辑器生成极小中文字体

### 需要在系统中安装:`fonttools`,并配置环境变量
用到的命令行：
```
 pyftsubset fonts/${item.fontFile} --text=${item.title} --output-file=fontmin/${item.fontFile}
```

### 使用redis作为队列

### 使用postgres作为提取记录数据库