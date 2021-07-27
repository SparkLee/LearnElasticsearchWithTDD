# 索引模板

#### 创建/更新索引模板

> PUT _template/logs_template

```json
{
  "index_patterns": "logs-*",
  "order": 1,
  "settings": {
    "number_of_shards": 4,
    "number_of_replicas": 1
  },
  "mappings": {
    "properties": {
      "@timestamp": {
        "type": "date"
      }
    }
  },
  "aliases": {
    "{index}-alias": {}
  }
}
```

#### 查询索引模板

> GET _template/logs_template

#### 删除索引模板

> DELETE _template/logs_template

# 索引

#### 创建索引

> PUT logs-2021-07-27

> 如果创建的索引名称与索引模板的 index_patterns 匹配，则创建的索引会继承索引模板的 settings, mappings, aliases。

#### 查询索引

> GET logs-2021-07-27

> 确认索引是否继承了索引模板的 settings, mappings, aliases。

#### 删除索引

> DELETE logs-2021-07-27

# 文档

#### 创建文档

> POST logs-2021-07-27/_doc

```json
{
  "@timestamp": "2021-07-27T10:21:00",
  "user": {
    "id": "80001",
    "name": "Spark Lee"
  }
}
```

#### 查询文档

> GET logs-2021-07-27/_search

# 参考资料

- [@CSDN-Elastic 中国社区官方博客 - Elasticsearch: Index template](https://blog.csdn.net/UbuntuTouch/article/details/100553185)
