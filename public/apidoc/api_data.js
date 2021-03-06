define({ "api": [
  {
    "type": "get",
    "url": "/areas",
    "title": "全部数据",
    "description": "<p>全部数据</p>",
    "group": "Area",
    "permission": [
      {
        "name": "无"
      }
    ],
    "version": "1.0.0",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n   {\n       \"data\": [\n           {\n               \"id\": 1,\n               \"code\": 340000,\n               \"parent_id\": 0,\n               \"name\": \"安徽\"\n           },\n           {\n               \"id\": 2,\n               \"code\": 110000,\n               \"parent_id\": 0,\n               \"name\": \"北京\"\n           },\n           {\n               \"id\": 3,\n               \"code\": 500000,\n               \"parent_id\": 0,\n               \"name\": \"重庆\"\n           }\n           ...\n       ]\n   }",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/areas"
      }
    ],
    "filename": "App/Api/v1/Controllers/AreaController.php",
    "groupTitle": "地区",
    "name": "GetAreas"
  },
  {
    "type": "get",
    "url": "/areas/:code",
    "title": "单个地区",
    "description": "<p>单个地区 :code 通过code查询地区</p>",
    "group": "Area",
    "permission": [
      {
        "name": "无"
      }
    ],
    "version": "1.0.0",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n   {\n       \"data\": [\n           {\n               \"id\": 1,\n               \"code\": 340000,\n               \"parent_id\": 0,\n               \"name\": \"安徽\"\n           }\n       ]\n   }",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/areas/340000"
      }
    ],
    "filename": "App/Api/v1/Controllers/AreaController.php",
    "groupTitle": "地区",
    "name": "GetAreasCode"
  },
  {
    "type": "get",
    "url": "/childrens/:code",
    "title": "子地区",
    "description": "<p>子地区 :code 通过code查询子地区</p>",
    "group": "Area",
    "permission": [
      {
        "name": "无"
      }
    ],
    "version": "1.0.0",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n   {\n       \"data\": [\n           {\n               \"id\": 1,\n               \"code\": 340000,\n               \"parent_id\": 0,\n               \"name\": \"安徽\"\n           }\n       ]\n   }",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/childrens/340000"
      }
    ],
    "filename": "App/Api/v1/Controllers/AreaController.php",
    "groupTitle": "地区",
    "name": "GetChildrensCode"
  },
  {
    "type": "get",
    "url": "/citys",
    "title": "所有市区",
    "description": "<p>所有市区</p>",
    "group": "Area",
    "permission": [
      {
        "name": "无"
      }
    ],
    "version": "1.0.0",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n   {\n       \"data\": [\n           {\n               \"id\": 1,\n               \"code\": 340000,\n               \"parent_id\": 0,\n               \"name\": \"安徽\"\n           }\n       ]\n   }",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/citys"
      }
    ],
    "filename": "App/Api/v1/Controllers/AreaController.php",
    "groupTitle": "地区",
    "name": "GetCitys"
  },
  {
    "type": "get",
    "url": "/provinces",
    "title": "所有省",
    "description": "<p>所有省</p>",
    "group": "Area",
    "permission": [
      {
        "name": "无"
      }
    ],
    "version": "1.0.0",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n   {\n       \"data\": [\n           {\n               \"id\": 1,\n               \"code\": 340000,\n               \"parent_id\": 0,\n               \"name\": \"安徽\"\n           }\n       ]\n   }",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/provinces"
      }
    ],
    "filename": "App/Api/v1/Controllers/AreaController.php",
    "groupTitle": "地区",
    "name": "GetProvinces"
  },
  {
    "type": "get",
    "url": "/companies/jobs",
    "title": "公司招聘",
    "description": "<p>公司招聘</p>",
    "group": "Auth",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n\n{\n    \"data\": [\n        {\n            \"id\": 1,\n            \"job\": \"销售代表\",\n            \"total\": \"10人\",\n            \"education\": \"本科大学\",\n            \"experience\": \"2-3年\",\n            \"minsalary\": \"50000\",\n            \"content\": \"<p>要求就是不要命</p>\"\n        }\n    ]\n}\n\n没有招聘内容的时候为\n{\n    \"data\": []\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/companies/jobs"
      }
    ],
    "filename": "App/Api/v1/Controllers/CompanyController.php",
    "groupTitle": "用户",
    "name": "GetCompaniesJobs"
  },
  {
    "type": "get",
    "url": "/companies/products",
    "title": "产品列表",
    "description": "<p>产品列表 unit代表的单位见顶部(接口说明)</p>",
    "group": "Auth",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n\n{\n    \"data\": [\n        {\n            \"id\": 2,\n            \"title\": \"我有袋子100箱\",\n            \"price\": 100,\n            \"unit\": 5,\n            \"content\": \"<p style=\\\"margin-top: 0px; margin-bottom: 0px; text-rendering: optimizeLegibility; font-feature-settings: &#39;kern&#39; 1; font-kerning: normal; color: rgb(51, 51, 51); font-family: &quot;Arial Normal&quot;, Arial; font-size: 18px; white-space: normal;\\\">加工定制 是</p><p style=\\\"margin-top: 0px; margin-bottom: 0px; text-rendering: optimizeLegibility; font-feature-settings: &#39;kern&#39; 1; font-kerning: normal; color: rgb(51, 51, 51); font-family: &quot;Arial Normal&quot;, Arial; font-size: 18px; white-space: normal;\\\">用途 通用包装</p><p style=\\\"margin-top: 0px; margin-bottom: 0px; text-rendering: optimizeLegibility; font-feature-settings: &#39;kern&#39; 1; font-kerning: normal; color: rgb(51, 51, 51); font-family: &quot;Arial Normal&quot;, Arial; font-size: 18px; white-space: normal;\\\">底面侧面 无底无侧</p><p style=\\\"margin-top: 0px; margin-bottom: 0px; text-rendering: optimizeLegibility; font-feature-settings: &#39;kern&#39; 1; font-kerning: normal; color: rgb(51, 51, 51); font-family: &quot;Arial Normal&quot;, Arial; font-size: 18px; white-space: normal;\\\">供货类型 可定制</p><p style=\\\"margin-top: 0px; margin-bottom: 0px; text-rendering: optimizeLegibility; font-feature-settings: &#39;kern&#39; 1; font-kerning: normal; color: rgb(51, 51, 51); font-family: &quot;Arial Normal&quot;, Arial; font-size: 18px; white-space: normal;\\\">规格 400*300（mm*mm）</p><p style=\\\"margin-top: 0px; margin-bottom: 0px; text-rendering: optimizeLegibility; font-feature-settings: &#39;kern&#39; 1; font-kerning: normal; color: rgb(51, 51, 51); font-family: &quot;Arial Normal&quot;, Arial; font-size: 18px; white-space: normal;\\\">加印LOGO 可以</p><p style=\\\"margin-top: 0px; margin-bottom: 0px; text-rendering: optimizeLegibility; font-feature-settings: &#39;kern&#39; 1; font-kerning: normal; color: rgb(51, 51, 51); font-family: &quot;Arial Normal&quot;, Arial; font-size: 18px; white-space: normal;\\\">款式 手提袋</p><p style=\\\"margin-top: 0px; margin-bottom: 0px; text-rendering: optimizeLegibility; font-feature-settings: &#39;kern&#39; 1; font-kerning: normal; color: rgb(51, 51, 51); font-family: &quot;Arial Normal&quot;, Arial; font-size: 18px; white-space: normal;\\\">颜色 米白</p><p style=\\\"margin-top: 0px; margin-bottom: 0px; text-rendering: optimizeLegibility; font-feature-settings: &#39;kern&#39; 1; font-kerning: normal; color: rgb(51, 51, 51); font-family: &quot;Arial Normal&quot;, Arial; font-size: 18px; white-space: normal;\\\">印刷工艺 丝印</p><p style=\\\"margin-top: 0px; margin-bottom: 0px; text-rendering: optimizeLegibility; font-feature-settings: &#39;kern&#39; 1; font-kerning: normal; color: rgb(51, 51, 51); font-family: &quot;Arial Normal&quot;, Arial; font-size: 18px; white-space: normal;\\\">自重 285（g）</p><p style=\\\"margin-top: 0px; margin-bottom: 0px; text-rendering: optimizeLegibility; font-feature-settings: &#39;kern&#39; 1; font-kerning: normal; color: rgb(51, 51, 51); font-family: &quot;Arial Normal&quot;, Arial; font-size: 18px; white-space: normal;\\\">品牌 Martina</p><p style=\\\"margin-top: 0px; margin-bottom: 0px; text-rendering: optimizeLegibility; font-feature-settings: &#39;kern&#39; 1; font-kerning: normal; color: rgb(51, 51, 51); font-family: &quot;Arial Normal&quot;, Arial; font-size: 18px; white-space: normal;\\\">是否有现货 有</p><p><br/></p>\",\n            \"images\": [\n                \"http://stone.dev/uploads/products/2016/11/165204E76X.png\"\n            ]\n        }\n    ],\n    \"meta\": {\n        \"pagination\": {\n            \"total\": 1,\n            \"count\": 1,\n            \"per_page\": 15,\n            \"current_page\": 1,\n            \"total_pages\": 1,\n            \"links\": []\n        }\n    }\n}\n没有产品内容的时候为\n{\n    \"data\": []\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/companies/products"
      }
    ],
    "filename": "App/Api/v1/Controllers/CompanyController.php",
    "groupTitle": "用户",
    "name": "GetCompaniesProducts"
  },
  {
    "type": "get",
    "url": "/users/certification-in",
    "title": "我收到的认证",
    "description": "<p>我收到的认证</p>",
    "group": "Auth",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/users/certification-in"
      }
    ],
    "filename": "App/Api/v1/Controllers/AuthController.php",
    "groupTitle": "用户",
    "name": "GetUsersCertificationIn"
  },
  {
    "type": "get",
    "url": "/users/certification-out",
    "title": "我申请的认证",
    "description": "<p>我申请的认证</p>",
    "group": "Auth",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/users/certification-out"
      }
    ],
    "filename": "App/Api/v1/Controllers/AuthController.php",
    "groupTitle": "用户",
    "name": "GetUsersCertificationOut"
  },
  {
    "type": "get",
    "url": "/users/companies",
    "title": "当前用户公司信息",
    "description": "<p>当前用户公司信息</p>",
    "group": "Auth",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n    \"data\": {\n        \"id\": 3,\n        \"name\": \"测试公司\",\n        \"province\": \"北京市\",\n        \"city\": \"北京市\",\n        \"area\": \"石景山区\",\n        \"addressDetail\": \"\",\n        \"telephone\": \"0592-5928529\",\n        \"role\": \"1\",\n        \"photos\": [\n            \"/storage/companies/2016/11/192330UhMQ.png\"\n        ],\n        \"is_validate\": 0,\n        \"is_excellent\": 0\n    }\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/users/companies"
      }
    ],
    "filename": "App/Api/v1/Controllers/AuthController.php",
    "groupTitle": "用户",
    "name": "GetUsersCompanies"
  },
  {
    "type": "get",
    "url": "/users/demands",
    "title": "需求列表",
    "description": "<p>需求列表</p>",
    "group": "Auth",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n    \"data\": [\n        {\n            \"id\": 1,\n            \"title\": \"我需求质量好的袋子\",\n            \"quantity\": 1000,\n            \"unit\": 5,\n            \"images\": [\n                \"/uploads/products/2016/11/165305Y37a.png\"\n            ]\n        }\n    ],\n    \"meta\": {\n        \"pagination\": {\n            \"total\": 2,\n            \"count\": 2,\n            \"per_page\": 15,\n            \"current_page\": 1,\n            \"total_pages\": 1,\n            \"links\": []\n        }\n    }\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/users/demands"
      }
    ],
    "filename": "App/Api/v1/Controllers/DemandController.php",
    "groupTitle": "用户",
    "name": "GetUsersDemands"
  },
  {
    "type": "get",
    "url": "/users/demands/search",
    "title": "需求搜索",
    "description": "<p>需求搜索</p>",
    "group": "Auth",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "q",
            "description": "<p>搜索关键字</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n    \"data\": [\n        {\n            \"id\": 1,\n            \"title\": \"我需求质量好的袋子\",\n            \"quantity\": 1000,\n            \"unit\": 5,\n            \"images\": [\n                \"http://stone.dev/uploads/products/2016/11/165305Y37a.png\"\n            ],\n            \"is_excellent\": 0\n        },\n        {\n            \"id\": 2,\n            \"title\": \"我需求100袋包装袋\",\n            \"quantity\": 100,\n            \"unit\": 4,\n            \"images\": [\n                \"http://stone.dev/storage/images/00425874a34ae1fd522f96c753ee2b2b.jpg\"\n            ],\n            \"is_excellent\": 0\n        },\n        {\n            \"id\": 3,\n            \"title\": \"我需求100袋包装袋\",\n            \"quantity\": 1000,\n            \"unit\": 5,\n            \"images\": [\n                \"http://stone.dev/storage/images/00425874a34ae1fd522f96c753ee2b2b.jpg\"\n            ],\n            \"is_excellent\": 1\n        },\n        {\n            \"id\": 4,\n            \"title\": \"我需求100袋包装袋\",\n            \"quantity\": 100,\n            \"unit\": 4,\n            \"images\": [\n                \"http://stone.dev/storage/images/00425874a34ae1fd522f96c753ee2b2b.jpg\"\n            ],\n            \"is_excellent\": 0\n        },\n        {\n            \"id\": 6,\n            \"title\": \"我需求100袋包装袋\",\n            \"quantity\": 100,\n            \"unit\": 4,\n            \"images\": [\n                \"http://stone.dev/storage/images/00425874a34ae1fd522f96c753ee2b2b.jpg\"\n            ],\n            \"is_excellent\": 0\n        }\n    ],\n    \"meta\": {\n        \"pagination\": {\n            \"total\": 5,\n            \"count\": 5,\n            \"per_page\": 15,\n            \"current_page\": 1,\n            \"total_pages\": 1,\n            \"links\": []\n        }\n    }\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/users/demands/search"
      }
    ],
    "filename": "App/Api/v1/Controllers/DemandController.php",
    "groupTitle": "用户",
    "name": "GetUsersDemandsSearch"
  },
  {
    "type": "get",
    "url": "/users/:id",
    "title": "获取用户信息",
    "description": "<p>获取单个用户信息</p>",
    "group": "Auth",
    "permission": [
      {
        "name": "无"
      }
    ],
    "version": "1.0.0",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n    \"data\": {\n        \"id\": 1,\n        \"username\": \"admin\",\n        \"mobile\": \"13111111111\",\n        \"email\": \"admin@admin.com\",\n        \"avatar\": \"http://stone.dev/uploads/avatars/default/medium.png\",\n        \"created_at\": \"2016-11-02 15:57:24\"\n    }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "App/Api/v1/Controllers/AuthController.php",
    "groupTitle": "用户",
    "name": "GetUsersId"
  },
  {
    "type": "get",
    "url": "/users/:id/topics",
    "title": "用户话题列表",
    "description": "<p>用户话题列表 :id 用户ID</p>",
    "group": "Auth",
    "permission": [
      {
        "name": "无"
      }
    ],
    "version": "1.0.0",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/users/1/topics"
      }
    ],
    "filename": "App/Api/v1/Controllers/TopicController.php",
    "groupTitle": "用户",
    "name": "GetUsersIdTopics"
  },
  {
    "type": "get",
    "url": "/users/:id/votes",
    "title": "用户点赞列表",
    "description": "<p>用户点赞列表 :id 用户ID</p>",
    "group": "Auth",
    "permission": [
      {
        "name": "无"
      }
    ],
    "version": "1.0.0",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/users/1/votes"
      }
    ],
    "filename": "App/Api/v1/Controllers/TopicController.php",
    "groupTitle": "用户",
    "name": "GetUsersIdVotes"
  },
  {
    "type": "get",
    "url": "/users/infobymobile/:mobile",
    "title": "获取用户信息",
    "description": "<p>根据手机获取用户信息</p>",
    "group": "Auth",
    "permission": [
      {
        "name": "无"
      }
    ],
    "version": "1.0.0",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n    \"data\": {\n        \"id\": 1,\n        \"username\": \"admin\",\n        \"mobile\": \"13111111111\",\n        \"email\": \"admin@admin.com\",\n        \"avatar\": \"http://stone.dev/uploads/avatars/default/medium.png\",\n        \"created_at\": \"2016-11-02 15:57:24\"\n    }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "App/Api/v1/Controllers/AuthController.php",
    "groupTitle": "用户",
    "name": "GetUsersInfobymobileMobile"
  },
  {
    "type": "get",
    "url": "/users/join-in",
    "title": "我收到的加盟",
    "description": "<p>我收到的加盟</p>",
    "group": "Auth",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n    \"data\": [\n        {\n            \"id\": 15,\n            \"status\": 2,\n            \"company\": {\n                \"data\": {\n                    \"id\": 3,\n                    \"name\": \"测试公司\",\n                    \"province\": \"北京市\",\n                    \"city\": \"北京市\",\n                    \"area\": \"石景山区\",\n                    \"addressDetail\": \"\",\n                    \"telephone\": \"0592-5928529\",\n                    \"photos\": [\n                        \"/storage/companies/2016/11/192330UhMQ.png\"\n                    ],\n                    \"is_validate\": 0,\n                    \"is_excellent\": 0\n                }\n            }\n        }\n    ],\n    \"meta\": {\n        \"pagination\": {\n            \"total\": 1,\n            \"count\": 1,\n            \"per_page\": 15,\n            \"current_page\": 1,\n            \"total_pages\": 1,\n            \"links\": []\n        }\n    }\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/users/join-in"
      }
    ],
    "filename": "App/Api/v1/Controllers/AuthController.php",
    "groupTitle": "用户",
    "name": "GetUsersJoinIn"
  },
  {
    "type": "get",
    "url": "/users/join-out",
    "title": "我申请的加盟",
    "description": "<p>我申请的加盟</p>",
    "group": "Auth",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n    \"data\": [\n        {\n            \"id\": 15,\n            \"status\": 2,\n            \"company\": {\n                \"data\": {\n                    \"id\": 1,\n                    \"name\": \"航运城\",\n                    \"province\": \"福建省\",\n                    \"city\": \"厦门市\",\n                    \"area\": \"思明区\",\n                    \"addressDetail\": \"软件园二期24号之二306B\",\n                    \"telephone\": \"0592-5928529\",\n                    \"photos\": [\n                        \"/storage/companies/2016/11/192246tXXv.png\",\n                        \"/storage/companies/2016/11/192247z703.png\"\n                    ],\n                    \"is_validate\": 0,\n                    \"is_excellent\": 0\n                }\n            }\n        }\n    ],\n    \"meta\": {\n        \"pagination\": {\n            \"total\": 1,\n            \"count\": 1,\n            \"per_page\": 15,\n            \"current_page\": 1,\n            \"total_pages\": 1,\n            \"links\": []\n        }\n    }\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/users/join-out"
      }
    ],
    "filename": "App/Api/v1/Controllers/AuthController.php",
    "groupTitle": "用户",
    "name": "GetUsersJoinOut"
  },
  {
    "type": "get",
    "url": "/users/me",
    "title": "当前用户信息",
    "description": "<p>当前用户信息</p>",
    "group": "Auth",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n    \"data\": {\n        \"user\": {\n            \"id\": 2,\n            \"username\": \"user\",\n            \"name\": \"name\",\n            \"mobile\": \"13113113111\",\n            \"email\": \"user@user.com\",\n            \"avatar\": \"http://stone.dev/uploads/avatars/default/medium.png\",\n            \"created_at\": \"2016-11-02 15:57:24\"\n        },\n        \"company\": {\n            \"id\": 3,\n            \"name\": \"测试公司\",\n            \"province\": \"北京市\",\n            \"city\": \"北京市\",\n            \"area\": \"石景山区\",\n            \"addressDetail\": \"\",\n            \"telephone\": \"0592-5928529\",\n            \"role\": \"1\",\n            \"photos\": \"http://stone.dev/storage/companies/2016/11/192330UhMQ.png\",\n            \"is_validate\": 0,\n            \"is_excellent\": 0\n        }\n    }\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/users/me"
      }
    ],
    "filename": "App/Api/v1/Controllers/AuthController.php",
    "groupTitle": "用户",
    "name": "GetUsersMe"
  },
  {
    "type": "get",
    "url": "/users/products/search",
    "title": "产品搜索",
    "description": "<p>产品搜索</p>",
    "group": "Auth",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "q",
            "description": "<p>搜索关键字</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n    \"data\": [\n        {\n            \"id\": 1,\n            \"title\": \"产品标题\",\n            \"price\": 1.2,\n            \"unit\": 1,\n            \"content\": \"<p>产品很好很好产品很好很好产品很好很好产品很好很好</p>\",\n            \"images\": \"http://stone.dev/uploads/products/2016/11/092739rqKq.png\"\n        },\n        {\n            \"id\": 3,\n            \"title\": \"我要更新一个产品4\",\n            \"price\": 1000,\n            \"unit\": 1,\n            \"content\": \"内容就是产品够好你买不买\",\n            \"images\": \"http://stone.dev/uploads/products/2016/11/165204E76X.png\"\n        }\n    ],\n    \"meta\": {\n        \"pagination\": {\n            \"total\": 2,\n            \"count\": 2,\n            \"per_page\": 15,\n            \"current_page\": 1,\n            \"total_pages\": 1,\n            \"links\": []\n        }\n    }\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/users/products/search"
      }
    ],
    "filename": "App/Api/v1/Controllers/ProductController.php",
    "groupTitle": "用户",
    "name": "GetUsersProductsSearch"
  },
  {
    "type": "get",
    "url": "/users/supplies",
    "title": "供应列表",
    "description": "<p>供应列表</p>",
    "group": "Auth",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n    \"data\": [\n        {\n            \"id\": 1,\n            \"title\": \"我有100袋包装袋\",\n            \"images\": [\n                \"/storage/images/00425874a34ae1fd522f96c753ee2b2b.jpg\"\n            ],\n            \"content\": \"我就需要这么多包装袋\"\n        }\n    ],\n    \"meta\": {\n        \"pagination\": {\n            \"total\": 1,\n            \"count\": 1,\n            \"per_page\": 15,\n            \"current_page\": 1,\n            \"total_pages\": 1,\n            \"links\": []\n        }\n    }\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/users/supplies"
      }
    ],
    "filename": "App/Api/v1/Controllers/SupplyController.php",
    "groupTitle": "用户",
    "name": "GetUsersSupplies"
  },
  {
    "type": "get",
    "url": "/users/supplies/search",
    "title": "供应搜索",
    "description": "<p>供应搜索</p>",
    "group": "Auth",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "q",
            "description": "<p>搜索关键字</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n    \"data\": [\n        {\n            \"id\": 2,\n            \"title\": \"我需求100袋包装袋\",\n            \"images\": [\n                \"http://stone.dev/storage/images/00425874a34ae1fd522f96c753ee2b2b.jpg\"\n            ],\n            \"content\": \"我就需要这么多包装袋\",\n            \"is_excellent\": 1\n        }\n    ],\n    \"meta\": {\n        \"pagination\": {\n            \"total\": 1,\n            \"count\": 1,\n            \"per_page\": 15,\n            \"current_page\": 1,\n            \"total_pages\": 1,\n            \"links\": []\n        }\n    }\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/users/supplies/search"
      }
    ],
    "filename": "App/Api/v1/Controllers/SupplyController.php",
    "groupTitle": "用户",
    "name": "GetUsersSuppliesSearch"
  },
  {
    "type": "get",
    "url": "/users/topics",
    "title": "用户话题列表",
    "description": "<p>用户话题列表 :id 用户ID</p>",
    "group": "Auth",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/users/topics"
      }
    ],
    "filename": "App/Api/v1/Controllers/TopicController.php",
    "groupTitle": "用户",
    "name": "GetUsersTopics"
  },
  {
    "type": "patch",
    "url": "/certifications/:id",
    "title": "认证审核",
    "description": "<p>认证审核</p>",
    "group": "Auth",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "size": "0,1,2",
            "optional": false,
            "field": "status",
            "description": "<p>审核状态</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/certifications/1"
      }
    ],
    "filename": "App/Api/v1/Controllers/CompanyController.php",
    "groupTitle": "用户",
    "name": "PatchCertificationsId"
  },
  {
    "type": "PATCH",
    "url": "/companies",
    "title": "更新公司信息",
    "description": "<p>更新公司时下面参数不是必传项</p>",
    "group": "Auth",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "size": "1,2,3",
            "optional": false,
            "field": "role",
            "description": "<p>身份</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>公司名或单位名</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "telephone",
            "description": "<p>电话</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "address",
            "description": "<p>地区code</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "addressDetail",
            "description": "<p>详细地区</p>"
          },
          {
            "group": "Parameter",
            "type": "Number[]",
            "optional": false,
            "field": "categories",
            "description": "<p>分类ID</p>"
          },
          {
            "group": "Parameter",
            "type": "String[]",
            "optional": false,
            "field": "licenses",
            "description": "<p>营业执照</p>"
          },
          {
            "group": "Parameter",
            "type": "String[]",
            "optional": false,
            "field": "photos",
            "description": "<p>公司照片或单位照片</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "notes",
            "description": "<p>公司加盟须知或单位认证须知</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "content",
            "description": "<p>公司简介或单位简介</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 201 Created",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/companies/"
      }
    ],
    "filename": "App/Api/v1/Controllers/CompanyController.php",
    "groupTitle": "用户",
    "name": "PatchCompanies"
  },
  {
    "type": "patch",
    "url": "/joins/:id",
    "title": "加盟审核",
    "description": "<p>加盟审核</p>",
    "group": "Auth",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "size": "0,1,2",
            "optional": false,
            "field": "status",
            "description": "<p>审核状态</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/joins/1"
      }
    ],
    "filename": "App/Api/v1/Controllers/CompanyController.php",
    "groupTitle": "用户",
    "name": "PatchJoinsId"
  },
  {
    "type": "PATCH",
    "url": "/password/reset",
    "title": "忘记密码",
    "description": "<p>忘记密码</p>",
    "group": "Auth",
    "permission": [
      {
        "name": "无"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "mobile",
            "description": "<p>手机</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "verifyCode",
            "description": "<p>验证码</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>新密码</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 204 No Content",
          "type": "json"
        }
      ]
    },
    "filename": "App/Api/v1/Controllers/AuthController.php",
    "groupTitle": "用户",
    "name": "PatchPasswordReset"
  },
  {
    "type": "PATCH",
    "url": "/users",
    "title": "更新用户信息",
    "description": "<p>更新用户信息</p>",
    "group": "Auth",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "avatar",
            "description": "<p>头像</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>用户名</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>真实姓名</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "mobile",
            "description": "<p>电话</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>邮箱</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n    \"data\": {\n        \"id\": 3,\n        \"username\": \"test\",\n        \"mobile\": \"13111111111\",\n        \"email\": \"test@test.com\",\n        \"avatar\": \"http://stone.dev/uploads/avatars/20161107085531.png\",\n        \"created_at\": \"2016-11-02 15:57:24\"\n    }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "App/Api/v1/Controllers/AuthController.php",
    "groupTitle": "用户",
    "name": "PatchUsers"
  },
  {
    "type": "PATCH",
    "url": "/users/password",
    "title": "修改密码",
    "description": "<p>修改密码</p>",
    "group": "Auth",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "old_password",
            "description": "<p>旧密码</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>新密码</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 204 No Content",
          "type": "json"
        }
      ]
    },
    "filename": "App/Api/v1/Controllers/AuthController.php",
    "groupTitle": "用户",
    "name": "PatchUsersPassword"
  },
  {
    "type": "post",
    "url": "/companies/",
    "title": "创建公司",
    "description": "<p>创建公司</p>",
    "group": "Auth",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "size": "1,2,3",
            "optional": false,
            "field": "role",
            "description": "<p>身份</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>公司名</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "telephone",
            "description": "<p>电话</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "address",
            "description": "<p>地区code</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "addressDetail",
            "description": "<p>详细地区</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 201 Created",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/companies"
      }
    ],
    "filename": "App/Api/v1/Controllers/CompanyController.php",
    "groupTitle": "用户",
    "name": "PostCompanies"
  },
  {
    "type": "post",
    "url": "/login",
    "title": "登录",
    "description": "<p>登录</p>",
    "group": "Auth",
    "permission": [
      {
        "name": "无"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "mobile",
            "description": "<p>手机</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>密码</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n    \"token_type\": \"Bearer\",\n    \"expires_in\": 3155673600,\n    \"access_token\": \"eyJ0eXAiOiJKV1Qi\",\n    \"refresh_token\": \"SYtfODuI03lgKyh\"\n           \"user\": {\n               \"id\": 16,\n               \"username\": \"username8\",\n               \"mobile\": \"15960838225\",\n               \"email\": {\n                   \"_default\": \"\",\n                   \"small\": \"\",\n                   \"medium\": \"\",\n                   \"large\": \"\"\n               },\n               \"avatar\": \"http://stone.dev/uploads/avatars/default/medium.png\",\n               \"created_at\": \"2016-11-07 07:49:28\"\n           }\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/login"
      }
    ],
    "filename": "App/Api/v1/Controllers/AuthController.php",
    "groupTitle": "用户",
    "name": "PostLogin"
  },
  {
    "type": "post",
    "url": "/register",
    "title": "注册",
    "description": "<p>注册</p>",
    "group": "Auth",
    "permission": [
      {
        "name": "无"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "mobile",
            "description": "<p>手机</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "verifyCode",
            "description": "<p>验证码</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>密码</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 201 Created",
          "type": "json"
        }
      ]
    },
    "filename": "App/Api/v1/Controllers/AuthController.php",
    "groupTitle": "用户",
    "name": "PostRegister"
  },
  {
    "type": "post",
    "url": "/verifycode",
    "title": "发送验证码",
    "description": "<p>发送验证码</p>",
    "group": "Auth",
    "permission": [
      {
        "name": "无"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "mobile_rule",
            "description": "<p>验证方式(注册check_mobile_unique  忘记密码check_mobile_exists)</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "mobile",
            "description": "<p>手机</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n    \"success\": true,\n    \"type\": \"sms_sent_success\",\n    \"message\": \"短信验证码发送成功，请注意查收\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 OK\n{\n    \"message\": \"发送过快！\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "App/Api/v1/Controllers/AuthController.php",
    "groupTitle": "用户",
    "name": "PostVerifycode"
  },
  {
    "type": "get",
    "url": "/companies/banner",
    "title": "公司轮播图",
    "description": "<p>公司轮播图</p>",
    "group": "Company",
    "permission": [
      {
        "name": "无"
      }
    ],
    "version": "1.0.0",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n    \"data\": [\n        {\n            \"id\": 7,\n            \"title\": \"我是招商加盟轮播1\",\n            \"image_url\": \"/storage/banners/f53014b75d5d55c2509a462581f49433.png\",\n            \"order\": 7,\n            \"link\": \"\",\n            \"published_from\": \"2016-11-30 17:49:05\",\n            \"published_to\": \"2016-12-31 17:49:05\"\n        },\n        {\n            \"id\": 8,\n            \"title\": \"我是招商加盟轮播2\",\n            \"image_url\": \"/storage/banners/a766a4fb33a03664caaad1017937f404.png\",\n            \"order\": 8,\n            \"link\": \"\",\n            \"published_from\": \"2016-11-30 17:49:26\",\n            \"published_to\": \"2016-12-31 17:49:26\"\n        }\n    ]\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/companies/banner"
      }
    ],
    "filename": "App/Api/v1/Controllers/CompanyController.php",
    "groupTitle": "公司",
    "name": "GetCompaniesBanner"
  },
  {
    "type": "get",
    "url": "/companies/categories/:id",
    "title": "公司分类",
    "description": "<p>公司分类 :id //1为采购商 //2为供应商 //3为机构/单位</p>",
    "group": "Company",
    "permission": [
      {
        "name": "无"
      }
    ],
    "version": "1.0.0",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n    \"data\": [\n        {\n            \"id\": 1,\n            \"name\": \"垃圾袋\"\n        },\n        {\n            \"id\": 2,\n            \"name\": \"背心袋\"\n        },\n        {\n            \"id\": 3,\n            \"name\": \"连卷袋\"\n        },\n        {\n            \"id\": 4,\n            \"name\": \"地膜\"\n        },\n        {\n            \"id\": 5,\n            \"name\": \"阻隔膜\"\n        },\n        {\n            \"id\": 6,\n            \"name\": \"快递袋\"\n        },\n        {\n            \"id\": 7,\n            \"name\": \"边封袋\"\n        },\n        {\n            \"id\": 8,\n            \"name\": \"其他\"\n        }\n    ]\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/companies/categories/1"
      }
    ],
    "filename": "App/Api/v1/Controllers/CompanyController.php",
    "groupTitle": "公司",
    "name": "GetCompaniesCategoriesId"
  },
  {
    "type": "get",
    "url": "/companies/:id",
    "title": "公司详情",
    "description": "<p>公司详情 :id 公司ID categories为分类数据 products 为产品数据 unit代表的单位见顶部(接口说明)</p>",
    "group": "Company",
    "permission": [
      {
        "name": "无"
      }
    ],
    "version": "1.0.0",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n{\n           \"data\": {\n               \"id\": 1,\n               \"name\": \"航运城\",\n               \"address\": \"福建厦门思明\",\n               \"telephone\": \"0592-5928529\",\n               \"content\": \"<p style=\\\"box-sizing: border-box; line-height: 1.7; margin-top: 10px; margin-bottom: 20px; font-size: 14.5px; color: rgb(82, 82, 82); font-family: \\\" source=\\\"\\\" sans=\\\"\\\" white-space:=\\\"\\\" background-color:=\\\"\\\">Next, define a route that contains a&nbsp;<code class=\\\" language-php\\\" style=\\\"box-sizing: border-box; font-family: Consolas, Monaco, \\\" andale=\\\"\\\" font-size:=\\\"\\\" color:=\\\"\\\" border-radius:=\\\"\\\" background:=\\\"\\\" padding:=\\\"\\\" 1px=\\\"\\\" text-shadow:=\\\"\\\" 0px=\\\"\\\" direction:=\\\"\\\" white-space:=\\\"\\\" word-spacing:=\\\"\\\" word-break:=\\\"\\\" line-height:=\\\"\\\" tab-size:=\\\"\\\" box-shadow:=\\\"\\\" vertical-align:=\\\"\\\"><span class=\\\"token punctuation\\\" style=\\\"box-sizing: border-box; color: rgb(153, 153, 153);\\\">{</span>user<span class=\\\"token punctuation\\\" style=\\\"box-sizing: border-box; color: rgb(153, 153, 153);\\\">}</span></code>&nbsp;parameter:</p><pre class=\\\" language-php\\\" style=\\\"box-sizing: border-box; overflow: auto; font-family: Consolas, Monaco, \\\" andale=\\\"\\\" font-size:=\\\"\\\" text-shadow:=\\\"\\\" 0px=\\\"\\\" direction:=\\\"\\\" word-break:=\\\"\\\" line-height:=\\\"\\\" tab-size:=\\\"\\\" margin-top:=\\\"\\\" margin-bottom:=\\\"\\\" background-color:=\\\"\\\" border-radius:=\\\"\\\" padding:=\\\"\\\" box-shadow:=\\\"\\\" 1px=\\\"\\\" vertical-align:=\\\"\\\">$router-&gt;get(&#39;profile/{user}&#39;,&nbsp;function(App\\\\User&nbsp;$user)&nbsp;{\\r\\n&nbsp;&nbsp;&nbsp;&nbsp;//});</pre><p style=\\\"box-sizing: border-box; line-height: 1.7; margin-top: 10px; margin-bottom: 20px; font-size: 14.5px; color: rgb(82, 82, 82); font-family: \\\" source=\\\"\\\" sans=\\\"\\\" white-space:=\\\"\\\" background-color:=\\\"\\\">Since we have bound all&nbsp;<code class=\\\" language-php\\\" style=\\\"box-sizing: border-box; font-family: Consolas, Monaco, \\\" andale=\\\"\\\" font-size:=\\\"\\\" color:=\\\"\\\" border-radius:=\\\"\\\" background:=\\\"\\\" padding:=\\\"\\\" 1px=\\\"\\\" text-shadow:=\\\"\\\" 0px=\\\"\\\" direction:=\\\"\\\" white-space:=\\\"\\\" word-spacing:=\\\"\\\" word-break:=\\\"\\\" line-height:=\\\"\\\" tab-size:=\\\"\\\" box-shadow:=\\\"\\\" vertical-align:=\\\"\\\"><span class=\\\"token punctuation\\\" style=\\\"box-sizing: border-box; color: rgb(153, 153, 153);\\\">{</span>user<span class=\\\"token punctuation\\\" style=\\\"box-sizing: border-box; color: rgb(153, 153, 153);\\\">}</span></code>&nbsp;parameters to the&nbsp;<code class=\\\" language-php\\\" style=\\\"box-sizing: border-box; font-family: Consolas, Monaco, \\\" andale=\\\"\\\" font-size:=\\\"\\\" color:=\\\"\\\" border-radius:=\\\"\\\" background:=\\\"\\\" padding:=\\\"\\\" 1px=\\\"\\\" text-shadow:=\\\"\\\" 0px=\\\"\\\" direction:=\\\"\\\" white-space:=\\\"\\\" word-spacing:=\\\"\\\" word-break:=\\\"\\\" line-height:=\\\"\\\" tab-size:=\\\"\\\" box-shadow:=\\\"\\\" vertical-align:=\\\"\\\">App\\\\<span class=\\\"token package\\\" style=\\\"box-sizing: border-box;\\\">User</span></code>&nbsp;model, a&nbsp;<code class=\\\" language-php\\\" style=\\\"box-sizing: border-box; font-family: Consolas, Monaco, \\\" andale=\\\"\\\" font-size:=\\\"\\\" color:=\\\"\\\" border-radius:=\\\"\\\" background:=\\\"\\\" padding:=\\\"\\\" 1px=\\\"\\\" text-shadow:=\\\"\\\" 0px=\\\"\\\" direction:=\\\"\\\" white-space:=\\\"\\\" word-spacing:=\\\"\\\" word-break:=\\\"\\\" line-height:=\\\"\\\" tab-size:=\\\"\\\" box-shadow:=\\\"\\\" vertical-align:=\\\"\\\">User</code>&nbsp;instance will be injected into the route. So, for example, a request to&nbsp;<code class=\\\" language-php\\\" style=\\\"box-sizing: border-box; font-family: Consolas, Monaco, \\\" andale=\\\"\\\" font-size:=\\\"\\\" color:=\\\"\\\" border-radius:=\\\"\\\" background:=\\\"\\\" padding:=\\\"\\\" 1px=\\\"\\\" text-shadow:=\\\"\\\" 0px=\\\"\\\" direction:=\\\"\\\" white-space:=\\\"\\\" word-spacing:=\\\"\\\" word-break:=\\\"\\\" line-height:=\\\"\\\" tab-size:=\\\"\\\" box-shadow:=\\\"\\\" vertical-align:=\\\"\\\">profile<span class=\\\"token operator\\\" style=\\\"box-sizing: border-box; color: rgb(85, 85, 85);\\\">/</span><span class=\\\"token number\\\" style=\\\"box-sizing: border-box; color: rgb(218, 86, 74);\\\">1</span></code>&nbsp;will inject the&nbsp;<code class=\\\" language-php\\\" style=\\\"box-sizing: border-box; font-family: Consolas, Monaco, \\\" andale=\\\"\\\" font-size:=\\\"\\\" color:=\\\"\\\" border-radius:=\\\"\\\" background:=\\\"\\\" padding:=\\\"\\\" 1px=\\\"\\\" text-shadow:=\\\"\\\" 0px=\\\"\\\" direction:=\\\"\\\" white-space:=\\\"\\\" word-spacing:=\\\"\\\" word-break:=\\\"\\\" line-height:=\\\"\\\" tab-size:=\\\"\\\" box-shadow:=\\\"\\\" vertical-align:=\\\"\\\">User</code>&nbsp;instance from the database which has an ID of&nbsp;<code class=\\\" language-php\\\" style=\\\"box-sizing: border-box; font-family: Consolas, Monaco, \\\" andale=\\\"\\\" font-size:=\\\"\\\" color:=\\\"\\\" border-radius:=\\\"\\\" background:=\\\"\\\" padding:=\\\"\\\" 1px=\\\"\\\" text-shadow:=\\\"\\\" 0px=\\\"\\\" direction:=\\\"\\\" white-space:=\\\"\\\" word-spacing:=\\\"\\\" word-break:=\\\"\\\" line-height:=\\\"\\\" tab-size:=\\\"\\\" box-shadow:=\\\"\\\" vertical-align:=\\\"\\\"><span class=\\\"token number\\\" style=\\\"box-sizing: border-box; color: rgb(218, 86, 74);\\\">1</span></code>.</p><p style=\\\"box-sizing: border-box; line-height: 1.7; margin-top: 10px; margin-bottom: 20px; font-size: 14.5px; color: rgb(82, 82, 82); font-family: \\\" source=\\\"\\\" sans=\\\"\\\" white-space:=\\\"\\\" background-color:=\\\"\\\">If a matching model instance is not found in the database, a 404 HTTP response will be automatically generated.</p><h4 style=\\\"box-sizing: border-box; -webkit-font-smoothing: antialiased; margin-top: 35px; color: rgb(82, 82, 82); font-family: \\\" source=\\\"\\\" sans=\\\"\\\" white-space:=\\\"\\\" background-color:=\\\"\\\">Customizing The Resolution Logic</h4><p style=\\\"box-sizing: border-box; line-height: 1.7; margin-top: 10px; margin-bottom: 20px; font-size: 14.5px; color: rgb(82, 82, 82); font-family: \\\" source=\\\"\\\" sans=\\\"\\\" white-space:=\\\"\\\" background-color:=\\\"\\\">If you wish to use your own resolution logic, you may use the&nbsp;<code class=\\\" language-php\\\" style=\\\"box-sizing: border-box; font-family: Consolas, Monaco, \\\" andale=\\\"\\\" font-size:=\\\"\\\" color:=\\\"\\\" border-radius:=\\\"\\\" background:=\\\"\\\" padding:=\\\"\\\" 1px=\\\"\\\" text-shadow:=\\\"\\\" 0px=\\\"\\\" direction:=\\\"\\\" white-space:=\\\"\\\" word-spacing:=\\\"\\\" word-break:=\\\"\\\" line-height:=\\\"\\\" tab-size:=\\\"\\\" box-shadow:=\\\"\\\" vertical-align:=\\\"\\\"><span class=\\\"token scope\\\" style=\\\"box-sizing: border-box; color: rgb(218, 86, 74);\\\">Route<span class=\\\"token punctuation\\\" style=\\\"box-sizing: border-box; color: rgb(153, 153, 153);\\\">::</span></span>bind</code>&nbsp;method. The&nbsp;<code class=\\\" language-php\\\" style=\\\"box-sizing: border-box; font-family: Consolas, Monaco, \\\" andale=\\\"\\\" font-size:=\\\"\\\" color:=\\\"\\\" border-radius:=\\\"\\\" background:=\\\"\\\" padding:=\\\"\\\" 1px=\\\"\\\" text-shadow:=\\\"\\\" 0px=\\\"\\\" direction:=\\\"\\\" white-space:=\\\"\\\" word-spacing:=\\\"\\\" word-break:=\\\"\\\" line-height:=\\\"\\\" tab-size:=\\\"\\\" box-shadow:=\\\"\\\" vertical-align:=\\\"\\\">Closure</code>you pass to the&nbsp;<code class=\\\" language-php\\\" style=\\\"box-sizing: border-box; font-family: Consolas, Monaco, \\\" andale=\\\"\\\" font-size:=\\\"\\\" color:=\\\"\\\" border-radius:=\\\"\\\" background:=\\\"\\\" padding:=\\\"\\\" 1px=\\\"\\\" text-shadow:=\\\"\\\" 0px=\\\"\\\" direction:=\\\"\\\" white-space:=\\\"\\\" word-spacing:=\\\"\\\" word-break:=\\\"\\\" line-height:=\\\"\\\" tab-size:=\\\"\\\" box-shadow:=\\\"\\\" vertical-align:=\\\"\\\">bind</code>&nbsp;method will receive the value of the URI segment and should return the instance of the class that should be injected into the route:</p><pre class=\\\" language-php\\\" style=\\\"box-sizing: border-box; overflow: auto; font-family: Consolas, Monaco, \\\" andale=\\\"\\\" font-size:=\\\"\\\" text-shadow:=\\\"\\\" 0px=\\\"\\\" direction:=\\\"\\\" word-break:=\\\"\\\" line-height:=\\\"\\\" tab-size:=\\\"\\\" margin-top:=\\\"\\\" margin-bottom:=\\\"\\\" background-color:=\\\"\\\" border-radius:=\\\"\\\" padding:=\\\"\\\" box-shadow:=\\\"\\\" 1px=\\\"\\\" vertical-align:=\\\"\\\">$router-&gt;bind(&#39;user&#39;,&nbsp;function&nbsp;($value)&nbsp;{\\r\\n&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;App\\\\User::where(&#39;name&#39;,&nbsp;$value)-&gt;first();});</pre><p style=\\\"box-sizing: border-box; line-height: 1.7; margin-top: 10px; margin-bottom: 20px; font-size: 14.5px; color: rgb(82, 82, 82); font-family: \\\" source=\\\"\\\" sans=\\\"\\\" white-space:=\\\"\\\" background-color:=\\\"\\\"><a style=\\\"box-sizing: border-box; color: rgb(244, 100, 95); text-decoration: underline; background-color: transparent;\\\" name=\\\"form-method-spoofing\\\"></a></p><h2 style=\\\"box-sizing: border-box; -webkit-font-smoothing: antialiased; font-size: 30px; font-weight: 400; margin-top: 55px; position: relative; color: rgb(82, 82, 82); font-family: \\\" source=\\\"\\\" sans=\\\"\\\" white-space:=\\\"\\\" background-color:=\\\"\\\"><a href=\\\"https://laravel.com/docs/5.3/routing#form-method-spoofing\\\" style=\\\"box-sizing: border-box; color: rgb(82, 82, 82); text-decoration: none; background-color: transparent;\\\">Form Method Spoofing</a></h2><p style=\\\"box-sizing: border-box; line-height: 1.7; margin-top: 10px; margin-bottom: 20px; font-size: 14.5px; color: rgb(82, 82, 82); font-family: \\\" source=\\\"\\\" sans=\\\"\\\" white-space:=\\\"\\\" background-color:=\\\"\\\">HTML forms do not support&nbsp;<code class=\\\" language-php\\\" style=\\\"box-sizing: border-box; font-family: Consolas, Monaco, \\\" andale=\\\"\\\" font-size:=\\\"\\\" color:=\\\"\\\" border-radius:=\\\"\\\" background:=\\\"\\\" padding:=\\\"\\\" 1px=\\\"\\\" text-shadow:=\\\"\\\" 0px=\\\"\\\" direction:=\\\"\\\" white-space:=\\\"\\\" word-spacing:=\\\"\\\" word-break:=\\\"\\\" line-height:=\\\"\\\" tab-size:=\\\"\\\" box-shadow:=\\\"\\\" vertical-align:=\\\"\\\"><span class=\\\"token constant\\\" style=\\\"box-sizing: border-box; color: rgb(218, 86, 74);\\\">PUT</span></code>,&nbsp;<code class=\\\" language-php\\\" style=\\\"box-sizing: border-box; font-family: Consolas, Monaco, \\\" andale=\\\"\\\" font-size:=\\\"\\\" color:=\\\"\\\" border-radius:=\\\"\\\" background:=\\\"\\\" padding:=\\\"\\\" 1px=\\\"\\\" text-shadow:=\\\"\\\" 0px=\\\"\\\" direction:=\\\"\\\" white-space:=\\\"\\\" word-spacing:=\\\"\\\" word-break:=\\\"\\\" line-height:=\\\"\\\" tab-size:=\\\"\\\" box-shadow:=\\\"\\\" vertical-align:=\\\"\\\"><span class=\\\"token constant\\\" style=\\\"box-sizing: border-box; color: rgb(218, 86, 74);\\\">PATCH</span></code>&nbsp;or&nbsp;<code class=\\\" language-php\\\" style=\\\"box-sizing: border-box; font-family: Consolas, Monaco, \\\" andale=\\\"\\\" font-size:=\\\"\\\" color:=\\\"\\\" border-radius:=\\\"\\\" background:=\\\"\\\" padding:=\\\"\\\" 1px=\\\"\\\" text-shadow:=\\\"\\\" 0px=\\\"\\\" direction:=\\\"\\\" white-space:=\\\"\\\" word-spacing:=\\\"\\\" word-break:=\\\"\\\" line-height:=\\\"\\\" tab-size:=\\\"\\\" box-shadow:=\\\"\\\" vertical-align:=\\\"\\\"><span class=\\\"token constant\\\" style=\\\"box-sizing: border-box; color: rgb(218, 86, 74);\\\">DELETE</span></code>&nbsp;actions. So, when defining&nbsp;<code class=\\\" language-php\\\" style=\\\"box-sizing: border-box; font-family: Consolas, Monaco, \\\" andale=\\\"\\\" font-size:=\\\"\\\" color:=\\\"\\\" border-radius:=\\\"\\\" background:=\\\"\\\" padding:=\\\"\\\" 1px=\\\"\\\" text-shadow:=\\\"\\\" 0px=\\\"\\\" direction:=\\\"\\\" white-space:=\\\"\\\" word-spacing:=\\\"\\\" word-break:=\\\"\\\" line-height:=\\\"\\\" tab-size:=\\\"\\\" box-shadow:=\\\"\\\" vertical-align:=\\\"\\\"><span class=\\\"token constant\\\" style=\\\"box-sizing: border-box; color: rgb(218, 86, 74);\\\">PUT</span></code>,&nbsp;<code class=\\\" language-php\\\" style=\\\"box-sizing: border-box; font-family: Consolas, Monaco, \\\" andale=\\\"\\\" font-size:=\\\"\\\" color:=\\\"\\\" border-radius:=\\\"\\\" background:=\\\"\\\" padding:=\\\"\\\" 1px=\\\"\\\" text-shadow:=\\\"\\\" 0px=\\\"\\\" direction:=\\\"\\\" white-space:=\\\"\\\" word-spacing:=\\\"\\\" word-break:=\\\"\\\" line-height:=\\\"\\\" tab-size:=\\\"\\\" box-shadow:=\\\"\\\" vertical-align:=\\\"\\\"><span class=\\\"token constant\\\" style=\\\"box-sizing: border-box; color: rgb(218, 86, 74);\\\">PATCH</span></code>&nbsp;or&nbsp;<code class=\\\" language-php\\\" style=\\\"box-sizing: border-box; font-family: Consolas, Monaco, \\\" andale=\\\"\\\" font-size:=\\\"\\\" color:=\\\"\\\" border-radius:=\\\"\\\" background:=\\\"\\\" padding:=\\\"\\\" 1px=\\\"\\\" text-shadow:=\\\"\\\" 0px=\\\"\\\" direction:=\\\"\\\" white-space:=\\\"\\\" word-spacing:=\\\"\\\" word-break:=\\\"\\\" line-height:=\\\"\\\" tab-size:=\\\"\\\" box-shadow:=\\\"\\\" vertical-align:=\\\"\\\"><span class=\\\"token constant\\\" style=\\\"box-sizing: border-box; color: rgb(218, 86, 74);\\\">DELETE</span></code>&nbsp;routes that are called from an HTML form, you will need to add a hidden&nbsp;<code class=\\\" language-php\\\" style=\\\"box-sizing: border-box; font-family: Consolas, Monaco, \\\" andale=\\\"\\\" font-size:=\\\"\\\" color:=\\\"\\\" border-radius:=\\\"\\\" background:=\\\"\\\" padding:=\\\"\\\" 1px=\\\"\\\" text-shadow:=\\\"\\\" 0px=\\\"\\\" direction:=\\\"\\\" white-space:=\\\"\\\" word-spacing:=\\\"\\\" word-break:=\\\"\\\" line-height:=\\\"\\\" tab-size:=\\\"\\\" box-shadow:=\\\"\\\" vertical-align:=\\\"\\\">_method</code>&nbsp;field to the form. The value sent with the&nbsp;<code class=\\\" language-php\\\" style=\\\"box-sizing: border-box; font-family: Consolas, Monaco, \\\" andale=\\\"\\\" font-size:=\\\"\\\" color:=\\\"\\\" border-radius:=\\\"\\\" background:=\\\"\\\" padding:=\\\"\\\" 1px=\\\"\\\" text-shadow:=\\\"\\\" 0px=\\\"\\\" direction:=\\\"\\\" white-space:=\\\"\\\" word-spacing:=\\\"\\\" word-break:=\\\"\\\" line-height:=\\\"\\\" tab-size:=\\\"\\\" box-shadow:=\\\"\\\" vertical-align:=\\\"\\\">_method</code>&nbsp;field will be used as the HTTP request method:</p><pre class=\\\" language-php\\\" style=\\\"box-sizing: border-box; overflow: auto; font-family: Consolas, Monaco, \\\" andale=\\\"\\\" font-size:=\\\"\\\" text-shadow:=\\\"\\\" 0px=\\\"\\\" direction:=\\\"\\\" word-break:=\\\"\\\" line-height:=\\\"\\\" tab-size:=\\\"\\\" margin-top:=\\\"\\\" margin-bottom:=\\\"\\\" background-color:=\\\"\\\" border-radius:=\\\"\\\" padding:=\\\"\\\" box-shadow:=\\\"\\\" 1px=\\\"\\\" vertical-align:=\\\"\\\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/></pre><p style=\\\"box-sizing: border-box; line-height: 1.7; margin-top: 10px; margin-bottom: 20px; font-size: 14.5px; color: rgb(82, 82, 82); font-family: \\\" source=\\\"\\\" sans=\\\"\\\" white-space:=\\\"\\\" background-color:=\\\"\\\">You may use the&nbsp;<code class=\\\" language-php\\\" style=\\\"box-sizing: border-box; font-family: Consolas, Monaco, \\\" andale=\\\"\\\" font-size:=\\\"\\\" color:=\\\"\\\" border-radius:=\\\"\\\" background:=\\\"\\\" padding:=\\\"\\\" 1px=\\\"\\\" text-shadow:=\\\"\\\" 0px=\\\"\\\" direction:=\\\"\\\" white-space:=\\\"\\\" word-spacing:=\\\"\\\" word-break:=\\\"\\\" line-height:=\\\"\\\" tab-size:=\\\"\\\" box-shadow:=\\\"\\\" vertical-align:=\\\"\\\">method_field</code>&nbsp;helper to generate the&nbsp;<code class=\\\" language-php\\\" style=\\\"box-sizing: border-box; font-family: Consolas, Monaco, \\\" andale=\\\"\\\" font-size:=\\\"\\\" color:=\\\"\\\" border-radius:=\\\"\\\" background:=\\\"\\\" padding:=\\\"\\\" 1px=\\\"\\\" text-shadow:=\\\"\\\" 0px=\\\"\\\" direction:=\\\"\\\" white-space:=\\\"\\\" word-spacing:=\\\"\\\" word-break:=\\\"\\\" line-height:=\\\"\\\" tab-size:=\\\"\\\" box-shadow:=\\\"\\\" vertical-align:=\\\"\\\">_method</code>&nbsp;input:</p><pre class=\\\" language-php\\\" style=\\\"box-sizing: border-box; overflow: auto; font-family: Consolas, Monaco, \\\" andale=\\\"\\\" font-size:=\\\"\\\" text-shadow:=\\\"\\\" 0px=\\\"\\\" direction:=\\\"\\\" word-break:=\\\"\\\" line-height:=\\\"\\\" tab-size:=\\\"\\\" margin-top:=\\\"\\\" margin-bottom:=\\\"\\\" background-color:=\\\"\\\" border-radius:=\\\"\\\" padding:=\\\"\\\" box-shadow:=\\\"\\\" 1px=\\\"\\\" vertical-align:=\\\"\\\">{{&nbsp;method_field(&#39;PUT&#39;)&nbsp;}}</pre><p style=\\\"box-sizing: border-box; line-height: 1.7; margin-top: 10px; margin-bottom: 20px; font-size: 14.5px; color: rgb(82, 82, 82); font-family: \\\" source=\\\"\\\" sans=\\\"\\\" white-space:=\\\"\\\" background-color:=\\\"\\\"><a style=\\\"box-sizing: border-box; color: rgb(244, 100, 95); text-decoration: underline; background-color: transparent;\\\" name=\\\"accessing-the-current-route\\\"></a></p><h2 style=\\\"box-sizing: border-box; -webkit-font-smoothing: antialiased; font-size: 30px; font-weight: 400; margin-top: 55px; position: relative; color: rgb(82, 82, 82); font-family: \\\" source=\\\"\\\" sans=\\\"\\\" white-space:=\\\"\\\" background-color:=\\\"\\\"><a href=\\\"https://laravel.com/docs/5.3/routing#accessing-the-current-route\\\" style=\\\"box-sizing: border-box; color: rgb(82, 82, 82); text-decoration: none; background-color: transparent;\\\">Accessing The Current Route</a></h2><p><br/></p>\",\n               \"photos\": [\n                   \"/storage/companies/2016/11/192246tXXv.png\",\n                   \"/storage/companies/2016/11/192247z703.png\"\n               ],\n               \"created_at\": \"2016-11-01 18:22:53\",\n               \"categories\": {\n                   \"data\": [\n                       {\n                           \"id\": 17,\n                           \"name\": \"环保塑料行业协会\"\n                       },\n                       {\n                           \"id\": 19,\n                           \"name\": \"政府机关\"\n                       },\n                       {\n                           \"id\": 20,\n                           \"name\": \"其他\"\n                       }\n                   ]\n               },\n               \"jobs\": {\n                   \"data\": [\n                       {\n                           \"id\": 1,\n                           \"job\": \"销售代表\",\n                           \"total\": \"10人\",\n                           \"education\": \"本科大学\",\n                           \"experience\": \"2-3年\",\n                           \"minsalary\": \"50000\",\n                           \"content\": \"<p>要求就是不要命</p>\"\n                       }\n                   ]\n               },\n               \"products\": {\n                   \"data\": [\n                       {\n                           \"id\": 1,\n                           \"title\": \"产品标题\",\n                           \"price\": 1.2,\n                           \"unit\": 1,\n                           \"content\": \"<p>产品很好很好产品很好很好产品很好很好产品很好很好</p>\",\n                           \"images\": [\n                               \"/uploads/products/2016/11/092739rqKq.png\"\n                           ]\n                       }\n                   ]\n               }\n           }\n       }",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/companies/1"
      }
    ],
    "filename": "App/Api/v1/Controllers/CompanyController.php",
    "groupTitle": "公司",
    "name": "GetCompaniesId"
  },
  {
    "type": "get",
    "url": "/companies/:id/join-certification",
    "title": "公司加盟或机构认证",
    "description": "<p>公司加盟或机构认证 :id 公司ID user 申请者用户信息 company 申请者公司信息</p>",
    "group": "Company",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n    \"data\": {\n        \"id\": 1,\n        \"name\": \"航运城\",\n        \"address\": \"福建省厦门市思明区\",\n        \"telephone\": \"0592-5928529\",\n        \"notes\": \"加盟须知就是你看了必须加盟\",\n        \"image\": [\n            \"/storage/companies/2016/11/192246tXXv.png\",\n            \"/storage/companies/2016/11/192247z703.png\"\n        ],\n        \"user\": {\n            \"data\": {\n                \"id\": 1,\n                \"username\": \"admin\",\n                \"mobile\": \"13111111111\",\n                \"email\": \"admin@admin.com\",\n                \"avatar\": \"http://stone.dev/uploads/avatars/default/medium.png\",\n                \"created_at\": \"2016-11-02 15:57:24\"\n            }\n        },\n        \"company\": {\n            \"data\": {\n                \"id\": 3,\n                \"name\": \"测试公司\",\n                \"address\": \"北京市北京市石景山区\",\n                \"telephone\": \"0592-5928529\",\n                \"photos\": [\n                    \"/storage/companies/2016/11/192330UhMQ.png\"\n                ]\n            }\n        }\n    }\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/companies/1/join-certification"
      }
    ],
    "filename": "App/Api/v1/Controllers/CompanyController.php",
    "groupTitle": "公司",
    "name": "GetCompaniesIdJoinCertification"
  },
  {
    "type": "get",
    "url": "/companies/role/:id",
    "title": "公司列表",
    "description": "<p>公司列表:id代表的身份见顶部(接口说明)</p>",
    "group": "Company",
    "permission": [
      {
        "name": "无"
      }
    ],
    "version": "1.0.0",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "is_validate",
            "description": "<p>认证 1//已认证  0//未认证</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "is_excellent",
            "description": "<p>推广 1//已认证  0//未认证</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n    \"data\": [\n        {\n            \"id\": 1,\n            \"name\": \"航运城\",\n            \"province\": \"福建省\",\n            \"city\": \"厦门市\",\n            \"area\": \"思明区\",\n            \"addressDetail\": \"软件园二期24号之二306B\",\n            \"telephone\": \"0592-5928529\",\n            \"photos\": [\n                \"/storage/companies/2016/11/192246tXXv.png\",\n                \"/storage/companies/2016/11/192247z703.png\"\n            ],\n            \"is_validate\": 0,\n            \"is_excellent\": 0\n        }\n    ],\n    \"meta\": {\n        \"pagination\": {\n            \"total\": 1,\n            \"count\": 1,\n            \"per_page\": 15,\n            \"current_page\": 1,\n            \"total_pages\": 1,\n            \"links\": []\n        }\n    }\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/companies/role/1"
      }
    ],
    "filename": "App/Api/v1/Controllers/CompanyController.php",
    "groupTitle": "公司",
    "name": "GetCompaniesRoleId"
  },
  {
    "type": "get",
    "url": "/companies/search",
    "title": "公司搜索",
    "description": "<p>公司搜索</p>",
    "group": "Company",
    "permission": [
      {
        "name": "无"
      }
    ],
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "q",
            "description": "<p>搜索关键字</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "size": "0,1,2,3",
            "optional": false,
            "field": "role",
            "description": "<p>企业性质</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "categories",
            "description": "<p>企业分类</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "address",
            "description": "<p>地区码</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n    \"data\": [\n        {\n            \"id\": 3,\n            \"name\": \"测试公司\",\n            \"province\": \"北京市\",\n            \"city\": \"北京市\",\n            \"area\": \"石景山区\",\n            \"addressDetail\": \"\",\n            \"telephone\": \"0592-5928529\",\n            \"photos\": \"http://stone.dev/storage/companies/2016/11/192330UhMQ.png\",\n            \"is_validate\": 0,\n            \"is_excellent\": 0\n        }\n    ],\n    \"meta\": {\n        \"pagination\": {\n            \"total\": 1,\n            \"count\": 1,\n            \"per_page\": 15,\n            \"current_page\": 1,\n            \"total_pages\": 1,\n            \"links\": []\n        }\n    }\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/companies/search"
      }
    ],
    "filename": "App/Api/v1/Controllers/CompanyController.php",
    "groupTitle": "公司",
    "name": "GetCompaniesSearch"
  },
  {
    "type": "post",
    "url": "/companies/:id/certifications",
    "title": "申请认证",
    "description": "<p>申请认证:id 公司ID</p>",
    "group": "Company",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String[]",
            "optional": false,
            "field": "identity_card[]",
            "description": "<p>身份证</p>"
          },
          {
            "group": "Parameter",
            "type": "String[]",
            "optional": false,
            "field": "licenses[]",
            "description": "<p>营业执照</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 201 Created",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/companies/1/certifications"
      }
    ],
    "filename": "App/Api/v1/Controllers/CompanyController.php",
    "groupTitle": "公司",
    "name": "PostCompaniesIdCertifications"
  },
  {
    "type": "post",
    "url": "/companies/:id/favorites",
    "title": "公司收藏",
    "description": "<p>公司收藏</p>",
    "group": "Company",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 201 Created",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/companies/1/favorites"
      }
    ],
    "filename": "App/Api/v1/Controllers/CompanyController.php",
    "groupTitle": "公司",
    "name": "PostCompaniesIdFavorites"
  },
  {
    "type": "post",
    "url": "/companies/:id/joins",
    "title": "申请加盟",
    "description": "<p>申请加盟:id 公司ID</p>",
    "group": "Company",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String[]",
            "optional": false,
            "field": "identity_card[]",
            "description": "<p>身份证</p>"
          },
          {
            "group": "Parameter",
            "type": "String[]",
            "optional": false,
            "field": "licenses[]",
            "description": "<p>营业执照</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 201 Created",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/companies/1/joins"
      }
    ],
    "filename": "App/Api/v1/Controllers/CompanyController.php",
    "groupTitle": "公司",
    "name": "PostCompaniesIdJoins"
  },
  {
    "type": "post",
    "url": "/companies/jobs",
    "title": "发布招聘",
    "description": "<p>发布招聘</p>",
    "group": "Company",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "job",
            "description": "<p>招聘职位</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "total",
            "description": "<p>招聘人数</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "education",
            "description": "<p>学历要求</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "experience",
            "description": "<p>工作年限</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "minsalary",
            "description": "<p>薪资待遇</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "content",
            "description": "<p>招聘内容</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 201 Created",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/companies/jobs"
      }
    ],
    "filename": "App/Api/v1/Controllers/CompanyController.php",
    "groupTitle": "公司",
    "name": "PostCompaniesJobs"
  },
  {
    "type": "post",
    "url": "/jobs/:id/favorites",
    "title": "招聘收藏",
    "description": "<p>招聘收藏</p>",
    "group": "Company",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 201 Created",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api//jobs/1/favorites"
      }
    ],
    "filename": "App/Api/v1/Controllers/CompanyController.php",
    "groupTitle": "公司",
    "name": "PostJobsIdFavorites"
  },
  {
    "type": "post",
    "url": "/products/:id/favorites",
    "title": "产品收藏",
    "description": "<p>产品收藏</p>",
    "group": "Company",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 201 Created",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/products/1/favorites"
      }
    ],
    "filename": "App/Api/v1/Controllers/CompanyController.php",
    "groupTitle": "公司",
    "name": "PostProductsIdFavorites"
  },
  {
    "type": "delete",
    "url": "/demands/:id",
    "title": "删除需求",
    "description": "<p>删除需求 :id 需要删除需求的ID</p>",
    "group": "Demand",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 204 No Content",
          "type": "json"
        }
      ]
    },
    "filename": "App/Api/v1/Controllers/DemandController.php",
    "groupTitle": "需求",
    "name": "DeleteDemandsId"
  },
  {
    "type": "get",
    "url": "/demands",
    "title": "需求列表",
    "description": "<p>需求列表</p>",
    "group": "Demand",
    "permission": [
      {
        "name": "无"
      }
    ],
    "version": "1.0.0",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n    \"data\": [\n        {\n            \"id\": 1,\n            \"title\": \"我需求质量好的袋子\",\n            \"quantity\": 1000,\n            \"unit\": 5,\n            \"images\": [\n                \"http://stone.dev/uploads/products/2016/11/165305Y37a.png\"\n            ],\n            \"is_excellent\": 0\n        },\n        {\n            \"id\": 2,\n            \"title\": \"我需求100袋包装袋\",\n            \"quantity\": 100,\n            \"unit\": 4,\n            \"images\": [\n                \"http://stone.dev/storage/images/00425874a34ae1fd522f96c753ee2b2b.jpg\"\n            ],\n            \"is_excellent\": 0\n        },\n        {\n            \"id\": 3,\n            \"title\": \"我需求100袋包装袋\",\n            \"quantity\": 1000,\n            \"unit\": 5,\n            \"images\": [\n                \"http://stone.dev/storage/images/00425874a34ae1fd522f96c753ee2b2b.jpg\"\n            ],\n            \"is_excellent\": 1\n        },\n        {\n            \"id\": 4,\n            \"title\": \"ghvff\",\n            \"quantity\": 45,\n            \"unit\": 3,\n            \"images\": \"http://192.168.1.41:8000/uploads/avatars/20161119060951_180x180.png\",\n            \"is_excellent\": 0\n        }\n    ],\n    \"meta\": {\n        \"pagination\": {\n            \"total\": 4,\n            \"count\": 4,\n            \"per_page\": 15,\n            \"current_page\": 1,\n            \"total_pages\": 1,\n            \"links\": []\n        }\n    }\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/demands"
      }
    ],
    "filename": "App/Api/v1/Controllers/DemandController.php",
    "groupTitle": "需求",
    "name": "GetDemands"
  },
  {
    "type": "get",
    "url": "/demands/:id",
    "title": "需求详情",
    "description": "<p>需求详情 :id 需求ID</p>",
    "group": "Demand",
    "permission": [
      {
        "name": "无"
      }
    ],
    "version": "1.0.0",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n    \"data\": {\n        \"id\": 2,\n        \"title\": \"我需求100袋包装袋\",\n        \"quantity\": 100,\n        \"unit\": 4,\n        \"content\": \"我就需要这么多包装袋\",\n        \"images\": [\n            \"http://stone.dev/storage/images/00425874a34ae1fd522f96c753ee2b2b.jpg\"\n        ],\n        \"is_excellent\": 0,\n        \"province\": \"福建省\",\n        \"city\": \"厦门市\",\n        \"area\": \"思明区\",\n        \"addressDetail\": \"HK排比哈哈哈哈他JJ他拒绝离开过来了来了太可怜了啦啦啦啦\",\n        \"user\": {\n            \"data\": {\n                \"id\": 1,\n                \"username\": \"admin\",\n                \"name\": \"管理员\",\n                \"mobile\": \"13111111111\",\n                \"email\": \"admin@admin.com\",\n                \"avatar\": {\n                    \"_default\": \"http://117.29.170.226:8000/uploads/avatars/20161212022331.png\",\n                    \"small\": \"http://117.29.170.226:8000/uploads/avatars/20161212022331_30x30.png\",\n                    \"medium\": \"http://117.29.170.226:8000/uploads/avatars/20161212022331_65x65.png\",\n                    \"large\": \"http://117.29.170.226:8000/uploads/avatars/20161212022331_180x180.png\"\n                },\n                \"created_at\": \"2016-11-02 07:57:24\"\n            }\n        }\n    }\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/demands/1"
      }
    ],
    "filename": "App/Api/v1/Controllers/DemandController.php",
    "groupTitle": "需求",
    "name": "GetDemandsId"
  },
  {
    "type": "get",
    "url": "/demands/search",
    "title": "需求搜索",
    "description": "<p>需求搜索</p>",
    "group": "Demand",
    "permission": [
      {
        "name": "无"
      }
    ],
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "q",
            "description": "<p>搜索关键字</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n    \"data\": [\n        {\n            \"id\": 1,\n            \"title\": \"我需求质量好的袋子\",\n            \"quantity\": 1000,\n            \"unit\": 5,\n            \"images\": [\n                \"http://stone.dev/uploads/products/2016/11/165305Y37a.png\"\n            ],\n            \"is_excellent\": 0\n        },\n        {\n            \"id\": 2,\n            \"title\": \"我需求100袋包装袋\",\n            \"quantity\": 100,\n            \"unit\": 4,\n            \"images\": [\n                \"http://stone.dev/storage/images/00425874a34ae1fd522f96c753ee2b2b.jpg\"\n            ],\n            \"is_excellent\": 0\n        },\n        {\n            \"id\": 3,\n            \"title\": \"我需求100袋包装袋\",\n            \"quantity\": 1000,\n            \"unit\": 5,\n            \"images\": [\n                \"http://stone.dev/storage/images/00425874a34ae1fd522f96c753ee2b2b.jpg\"\n            ],\n            \"is_excellent\": 1\n        },\n        {\n            \"id\": 4,\n            \"title\": \"我需求100袋包装袋\",\n            \"quantity\": 100,\n            \"unit\": 4,\n            \"images\": [\n                \"http://stone.dev/storage/images/00425874a34ae1fd522f96c753ee2b2b.jpg\"\n            ],\n            \"is_excellent\": 0\n        },\n        {\n            \"id\": 6,\n            \"title\": \"我需求100袋包装袋\",\n            \"quantity\": 100,\n            \"unit\": 4,\n            \"images\": [\n                \"http://stone.dev/storage/images/00425874a34ae1fd522f96c753ee2b2b.jpg\"\n            ],\n            \"is_excellent\": 0\n        }\n    ],\n    \"meta\": {\n        \"pagination\": {\n            \"total\": 5,\n            \"count\": 5,\n            \"per_page\": 15,\n            \"current_page\": 1,\n            \"total_pages\": 1,\n            \"links\": []\n        }\n    }\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/demands/search"
      }
    ],
    "filename": "App/Api/v1/Controllers/DemandController.php",
    "groupTitle": "需求",
    "name": "GetDemandsSearch"
  },
  {
    "type": "PATCH",
    "url": "/demands/:id",
    "title": "更新需求",
    "description": "<p>更新需求 :id为需求ID</p>",
    "group": "Demand",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>标题</p>"
          },
          {
            "group": "Parameter",
            "type": "Int",
            "optional": false,
            "field": "quantity",
            "description": "<p>数量</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "allowedValues": [
              "1",
              "2",
              "3",
              "4",
              "5"
            ],
            "optional": false,
            "field": "unit",
            "description": "<p>单位</p>"
          },
          {
            "group": "Parameter",
            "type": "String[]",
            "optional": false,
            "field": "images[]",
            "description": "<p>图片</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "content",
            "description": "<p>内容</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n    \"data\": {\n        \"id\": 3,\n        \"title\": \"我需求100袋包装袋\",\n        \"quantity\": \"1000\",\n        \"unit\": \"5\",\n        \"content\": \"我就需要这么多包装袋\",\n        \"images\": [\n            \"/storage/images/00425874a34ae1fd522f96c753ee2b2b.jpg\"\n        ]\n    }\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/demands/1"
      }
    ],
    "filename": "App/Api/v1/Controllers/DemandController.php",
    "groupTitle": "需求",
    "name": "PatchDemandsId"
  },
  {
    "type": "post",
    "url": "/demands",
    "title": "发布需求",
    "description": "<p>发布需求 unit代表的单位见顶部(接口说明)</p>",
    "group": "Demand",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>标题</p>"
          },
          {
            "group": "Parameter",
            "type": "Int",
            "optional": false,
            "field": "quantity",
            "description": "<p>数量</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "allowedValues": [
              "1",
              "2",
              "3",
              "4",
              "5"
            ],
            "optional": false,
            "field": "unit",
            "description": "<p>单位</p>"
          },
          {
            "group": "Parameter",
            "type": "String[]",
            "optional": false,
            "field": "images[]",
            "description": "<p>图片</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "content",
            "description": "<p>内容</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 201 Created",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/demands"
      }
    ],
    "filename": "App/Api/v1/Controllers/DemandController.php",
    "groupTitle": "需求",
    "name": "PostDemands"
  },
  {
    "type": "post",
    "url": "/demands/:id/favorites",
    "title": "需求收藏",
    "description": "<p>需求收藏</p>",
    "group": "Demand",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 201 Created",
          "type": "json"
        }
      ]
    },
    "filename": "App/Api/v1/Controllers/DemandController.php",
    "groupTitle": "需求",
    "name": "PostDemandsIdFavorites"
  },
  {
    "type": "get",
    "url": "/exhibitions",
    "title": "展会列表",
    "description": "<p>展会列表</p>",
    "group": "Exhibition",
    "permission": [
      {
        "name": "无"
      }
    ],
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "size": "0,1,2,3,4,5,6",
            "optional": false,
            "field": "categories",
            "description": "<p>//0为全部或不传也可以</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n    \"data\": [\n        {\n            \"id\": 1,\n            \"title\": \"有一个展会\",\n            \"address\": \"xiamen\",\n            \"telephone\": \"05925910000\",\n            \"image\": \"http://stone.dev/storage/images/00425874a34ae1fd522f96c753ee2b2b.jpg\",\n            \"is_excellent\": 1,\n            \"is_top\": 1\n        }\n    ],\n    \"meta\": {\n        \"pagination\": {\n            \"total\": 1,\n            \"count\": 1,\n            \"per_page\": 15,\n            \"current_page\": 1,\n            \"total_pages\": 1,\n            \"links\": []\n        }\n    }\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/exhibitions"
      }
    ],
    "filename": "App/Api/v1/Controllers/ExhibitionController.php",
    "groupTitle": "展会",
    "name": "GetExhibitions"
  },
  {
    "type": "get",
    "url": "/exhibitions/banner",
    "title": "展会轮播图",
    "description": "<p>展会轮播图</p>",
    "group": "Exhibition",
    "permission": [
      {
        "name": "无"
      }
    ],
    "version": "1.0.0",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n    \"data\": [\n        {\n            \"id\": 5,\n            \"title\": \"我是展会轮播\",\n            \"image_url\": \"/storage/banners/f53014b75d5d55c2509a462581f49433.png\",\n            \"order\": 5,\n            \"link\": \"\",\n            \"published_from\": \"2016-11-30 17:48:21\",\n            \"published_to\": \"2016-12-31 17:48:21\"\n        },\n        {\n            \"id\": 6,\n            \"title\": \"我是展会轮播2\",\n            \"image_url\": \"/storage/banners/a766a4fb33a03664caaad1017937f404.png\",\n            \"order\": 6,\n            \"link\": \"\",\n            \"published_from\": \"2016-11-30 17:48:42\",\n            \"published_to\": \"2016-12-31 17:48:42\"\n        }\n    ]\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/exhibitions/banner"
      }
    ],
    "filename": "App/Api/v1/Controllers/ExhibitionController.php",
    "groupTitle": "展会",
    "name": "GetExhibitionsBanner"
  },
  {
    "type": "get",
    "url": "/exhibitions/categories",
    "title": "展会分类",
    "description": "<p>展会分类</p>",
    "group": "Exhibition",
    "permission": [
      {
        "name": "无"
      }
    ],
    "version": "1.0.0",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n    \"data\": [\n        {\n            \"id\": 1,\n            \"name\": \"原料\"\n        },\n        {\n            \"id\": 2,\n            \"name\": \"设备\"\n        },\n        {\n            \"id\": 3,\n            \"name\": \"成品\"\n        },\n        {\n            \"id\": 4,\n            \"name\": \"添加剂\"\n        },\n        {\n            \"id\": 5,\n            \"name\": \"检测\"\n        },\n        {\n            \"id\": 6,\n            \"name\": \"其他\"\n        }\n    ]\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/exhibitions/categories"
      }
    ],
    "filename": "App/Api/v1/Controllers/ExhibitionController.php",
    "groupTitle": "展会",
    "name": "GetExhibitionsCategories"
  },
  {
    "type": "get",
    "url": "/exhibitions/:id",
    "title": "展会详情",
    "description": "<p>展会详情</p>",
    "group": "Exhibition",
    "permission": [
      {
        "name": "无"
      }
    ],
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>展会ID</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n    \"data\": {\n        \"id\": 1,\n        \"title\": \"有一个展会\",\n        \"address\": \"xiamen\",\n        \"telephone\": \"05925910000\",\n        \"content\": \"<h2 style=\\\"box-sizing: border-box; -webkit-font-smoothing: antialiased; font-size: 30px; font-weight: 400; margin-top: 55px; position: relative; color: rgb(82, 82, 82); font-family: \\\" source=\\\"\\\" sans=\\\"\\\" white-space:=\\\"\\\" background-color:=\\\"\\\"><a href=\\\"http://docs.larastars.cn/zh/5.3/routing#route-model-binding\\\" style=\\\"box-sizing: border-box; background-color: transparent; color: rgb(82, 82, 82); text-decoration: none;\\\">路由模型绑定</a></h2><p style=\\\"box-sizing: border-box; line-height: 1.7; margin-top: 10px; margin-bottom: 20px; font-size: 14.5px; color: rgb(82, 82, 82); font-family: \\\" source=\\\"\\\" sans=\\\"\\\" white-space:=\\\"\\\" background-color:=\\\"\\\">当注入模型的 ID 到路由或控制器动作时，你经常会需要查询检索出相应 ID 的模型。Laravel 路由模型绑定提供了一种便利的方式去注入模型实例到路由中，比如，你可以通过传递 ID，来注入匹配 ID 的用户的整个模型实例到路由中。</p><p style=\\\"box-sizing: border-box; line-height: 1.7; margin-top: 10px; margin-bottom: 20px; font-size: 14.5px; color: rgb(82, 82, 82); font-family: \\\" source=\\\"\\\" sans=\\\"\\\" white-space:=\\\"\\\" background-color:=\\\"\\\"><a style=\\\"box-sizing: border-box; background-color: transparent; color: rgb(244, 100, 95); text-decoration: underline;\\\" name=\\\"implicit-binding\\\"></a></p><h3 style=\\\"box-sizing: border-box; -webkit-font-smoothing: antialiased; font-size: 24px; font-weight: 400; margin-top: 45px; color: rgb(82, 82, 82); font-family: \\\" source=\\\"\\\" sans=\\\"\\\" white-space:=\\\"\\\" background-color:=\\\"\\\">隐式绑定</h3><p style=\\\"box-sizing: border-box; line-height: 1.7; margin-top: 10px; margin-bottom: 20px; font-size: 14.5px; color: rgb(82, 82, 82); font-family: \\\" source=\\\"\\\" sans=\\\"\\\" white-space:=\\\"\\\" background-color:=\\\"\\\">Laravel 会自动的解析定义在路由或者控制器中具有类型提示的&nbsp;<code class=\\\" language-php\\\" style=\\\"box-sizing: border-box; font-family: Consolas, Monaco, \\\" andale=\\\"\\\" font-size:=\\\"\\\" background:=\\\"\\\" color:=\\\"\\\" padding:=\\\"\\\" 1px=\\\"\\\" border-radius:=\\\"\\\" text-shadow:=\\\"\\\" white=\\\"\\\" 0px=\\\"\\\" direction:=\\\"\\\" white-space:=\\\"\\\" word-spacing:=\\\"\\\" word-break:=\\\"\\\" line-height:=\\\"\\\" tab-size:=\\\"\\\" box-shadow:=\\\"\\\" vertical-align:=\\\"\\\">Eloquent</code>&nbsp;模型，它会根据变量名与参数名匹配，比如&nbsp;<code class=\\\" language-php\\\" style=\\\"box-sizing: border-box; font-family: Consolas, Monaco, \\\" andale=\\\"\\\" font-size:=\\\"\\\" background:=\\\"\\\" color:=\\\"\\\" padding:=\\\"\\\" 1px=\\\"\\\" border-radius:=\\\"\\\" text-shadow:=\\\"\\\" white=\\\"\\\" 0px=\\\"\\\" direction:=\\\"\\\" white-space:=\\\"\\\" word-spacing:=\\\"\\\" word-break:=\\\"\\\" line-height:=\\\"\\\" tab-size:=\\\"\\\" box-shadow:=\\\"\\\" vertical-align:=\\\"\\\">api<span class=\\\"token operator\\\" style=\\\"box-sizing: border-box; color: rgb(85, 85, 85);\\\">/</span>users<span class=\\\"token operator\\\" style=\\\"box-sizing: border-box; color: rgb(85, 85, 85);\\\">/</span><span class=\\\"token punctuation\\\" style=\\\"box-sizing: border-box; color: rgb(153, 153, 153);\\\">{</span>user<span class=\\\"token punctuation\\\" style=\\\"box-sizing: border-box; color: rgb(153, 153, 153);\\\">}</span></code>&nbsp;匹配&nbsp;<code class=\\\" language-php\\\" style=\\\"box-sizing: border-box; font-family: Consolas, Monaco, \\\" andale=\\\"\\\" font-size:=\\\"\\\" background:=\\\"\\\" color:=\\\"\\\" padding:=\\\"\\\" 1px=\\\"\\\" border-radius:=\\\"\\\" text-shadow:=\\\"\\\" white=\\\"\\\" 0px=\\\"\\\" direction:=\\\"\\\" white-space:=\\\"\\\" word-spacing:=\\\"\\\" word-break:=\\\"\\\" line-height:=\\\"\\\" tab-size:=\\\"\\\" box-shadow:=\\\"\\\" vertical-align:=\\\"\\\"><span class=\\\"token variable\\\" style=\\\"box-sizing: border-box; color: rgb(78, 161, 223);\\\">$user</span></code>&nbsp;变量：</p><pre class=\\\" language-php\\\" style=\\\"box-sizing: border-box; overflow: auto; font-family: Consolas, Monaco, \\\" andale=\\\"\\\" font-size:=\\\"\\\" text-shadow:=\\\"\\\" white=\\\"\\\" 0px=\\\"\\\" direction:=\\\"\\\" word-break:=\\\"\\\" line-height:=\\\"\\\" tab-size:=\\\"\\\" padding:=\\\"\\\" margin-top:=\\\"\\\" margin-bottom:=\\\"\\\" background-color:=\\\"\\\" border-radius:=\\\"\\\" box-shadow:=\\\"\\\" 1px=\\\"\\\" vertical-align:=\\\"\\\">Route::get(&#39;api/users/{user}&#39;,&nbsp;function&nbsp;(App\\\\User&nbsp;$user)&nbsp;{\\r\\n&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;$user-&gt;email;});</pre><p><br/></p>\",\n        \"image\": \"/storage/images/00425874a34ae1fd522f96c753ee2b2b.jpg\",\n        \"published_at\": \"2016-11-30 17:30:52\",\n        \"created_at\": \"2016-11-01 17:32:43\"\n    }\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/exhibitions/1"
      }
    ],
    "filename": "App/Api/v1/Controllers/ExhibitionController.php",
    "groupTitle": "展会",
    "name": "GetExhibitionsId"
  },
  {
    "type": "get",
    "url": "/exhibitions/search",
    "title": "展会搜索",
    "description": "<p>展会搜索</p>",
    "group": "Exhibition",
    "permission": [
      {
        "name": "无"
      }
    ],
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "size": "0,1,2,3,4,5,6",
            "optional": false,
            "field": "categories",
            "description": "<p>//0为全部或不传也可以</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "q",
            "description": "<p>搜索关键字</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n    \"data\": [\n        {\n            \"id\": 1,\n            \"title\": \"有一个展会\",\n            \"subtitle\": \"展会简单描述\",\n            \"address\": \"xiamen\",\n            \"telephone\": \"05925910000\",\n            \"content\": \"<h2 style=\\\"box-sizing: border-box; -webkit-font-smoothing: antialiased; font-size: 30px; font-weight: 400; margin-top: 55px; position: relative; color: rgb(82, 82, 82); font-family: \\\" source=\\\"\\\" sans=\\\"\\\" white-space:=\\\"\\\" background-color:=\\\"\\\"><a href=\\\"http://docs.larastars.cn/zh/5.3/routing#route-model-binding\\\" style=\\\"box-sizing: border-box; background-color: transparent; color: rgb(82, 82, 82); text-decoration: none;\\\">路由模型绑定</a></h2><p style=\\\"box-sizing: border-box; line-height: 1.7; margin-top: 10px; margin-bottom: 20px; font-size: 14.5px; color: rgb(82, 82, 82); font-family: \\\" source=\\\"\\\" sans=\\\"\\\" white-space:=\\\"\\\" background-color:=\\\"\\\">当注入模型的 ID 到路由或控制器动作时，你经常会需要查询检索出相应 ID 的模型。Laravel 路由模型绑定提供了一种便利的方式去注入模型实例到路由中，比如，你可以通过传递 ID，来注入匹配 ID 的用户的整个模型实例到路由中。</p><p style=\\\"box-sizing: border-box; line-height: 1.7; margin-top: 10px; margin-bottom: 20px; font-size: 14.5px; color: rgb(82, 82, 82); font-family: \\\" source=\\\"\\\" sans=\\\"\\\" white-space:=\\\"\\\" background-color:=\\\"\\\"><a style=\\\"box-sizing: border-box; background-color: transparent; color: rgb(244, 100, 95); text-decoration: underline;\\\" name=\\\"implicit-binding\\\"></a></p><h3 style=\\\"box-sizing: border-box; -webkit-font-smoothing: antialiased; font-size: 24px; font-weight: 400; margin-top: 45px; color: rgb(82, 82, 82); font-family: \\\" source=\\\"\\\" sans=\\\"\\\" white-space:=\\\"\\\" background-color:=\\\"\\\">隐式绑定</h3><p style=\\\"box-sizing: border-box; line-height: 1.7; margin-top: 10px; margin-bottom: 20px; font-size: 14.5px; color: rgb(82, 82, 82); font-family: \\\" source=\\\"\\\" sans=\\\"\\\" white-space:=\\\"\\\" background-color:=\\\"\\\">Laravel 会自动的解析定义在路由或者控制器中具有类型提示的&nbsp;<code class=\\\" language-php\\\" style=\\\"box-sizing: border-box; font-family: Consolas, Monaco, \\\" andale=\\\"\\\" font-size:=\\\"\\\" background:=\\\"\\\" color:=\\\"\\\" padding:=\\\"\\\" 1px=\\\"\\\" border-radius:=\\\"\\\" text-shadow:=\\\"\\\" white=\\\"\\\" 0px=\\\"\\\" direction:=\\\"\\\" white-space:=\\\"\\\" word-spacing:=\\\"\\\" word-break:=\\\"\\\" line-height:=\\\"\\\" tab-size:=\\\"\\\" box-shadow:=\\\"\\\" vertical-align:=\\\"\\\">Eloquent</code>&nbsp;模型，它会根据变量名与参数名匹配，比如&nbsp;<code class=\\\" language-php\\\" style=\\\"box-sizing: border-box; font-family: Consolas, Monaco, \\\" andale=\\\"\\\" font-size:=\\\"\\\" background:=\\\"\\\" color:=\\\"\\\" padding:=\\\"\\\" 1px=\\\"\\\" border-radius:=\\\"\\\" text-shadow:=\\\"\\\" white=\\\"\\\" 0px=\\\"\\\" direction:=\\\"\\\" white-space:=\\\"\\\" word-spacing:=\\\"\\\" word-break:=\\\"\\\" line-height:=\\\"\\\" tab-size:=\\\"\\\" box-shadow:=\\\"\\\" vertical-align:=\\\"\\\">api<span class=\\\"token operator\\\" style=\\\"box-sizing: border-box; color: rgb(85, 85, 85);\\\">/</span>users<span class=\\\"token operator\\\" style=\\\"box-sizing: border-box; color: rgb(85, 85, 85);\\\">/</span><span class=\\\"token punctuation\\\" style=\\\"box-sizing: border-box; color: rgb(153, 153, 153);\\\">{</span>user<span class=\\\"token punctuation\\\" style=\\\"box-sizing: border-box; color: rgb(153, 153, 153);\\\">}</span></code>&nbsp;匹配&nbsp;<code class=\\\" language-php\\\" style=\\\"box-sizing: border-box; font-family: Consolas, Monaco, \\\" andale=\\\"\\\" font-size:=\\\"\\\" background:=\\\"\\\" color:=\\\"\\\" padding:=\\\"\\\" 1px=\\\"\\\" border-radius:=\\\"\\\" text-shadow:=\\\"\\\" white=\\\"\\\" 0px=\\\"\\\" direction:=\\\"\\\" white-space:=\\\"\\\" word-spacing:=\\\"\\\" word-break:=\\\"\\\" line-height:=\\\"\\\" tab-size:=\\\"\\\" box-shadow:=\\\"\\\" vertical-align:=\\\"\\\"><span class=\\\"token variable\\\" style=\\\"box-sizing: border-box; color: rgb(78, 161, 223);\\\">$user</span></code>&nbsp;变量：</p><pre class=\\\" language-php\\\" style=\\\"box-sizing: border-box; overflow: auto; font-family: Consolas, Monaco, \\\" andale=\\\"\\\" font-size:=\\\"\\\" text-shadow:=\\\"\\\" white=\\\"\\\" 0px=\\\"\\\" direction:=\\\"\\\" word-break:=\\\"\\\" line-height:=\\\"\\\" tab-size:=\\\"\\\" padding:=\\\"\\\" margin-top:=\\\"\\\" margin-bottom:=\\\"\\\" background-color:=\\\"\\\" border-radius:=\\\"\\\" box-shadow:=\\\"\\\" 1px=\\\"\\\" vertical-align:=\\\"\\\">Route::get(&#39;api/users/{user}&#39;,&nbsp;function&nbsp;(App\\\\User&nbsp;$user)&nbsp;{\\r\\n&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;$user-&gt;email;});</pre><p><br/></p>\",\n            \"image\": \"http://stone.dev/storage/images/00425874a34ae1fd522f96c753ee2b2b.jpg\",\n            \"published_at\": \"2016-11-30 17:30:52\",\n            \"created_at\": \"2016-11-01 17:32:43\",\n            \"is_excellent\": 1,\n            \"is_top\": 1\n        }\n    ],\n    \"meta\": {\n        \"pagination\": {\n            \"total\": 1,\n            \"count\": 1,\n            \"per_page\": 15,\n            \"current_page\": 1,\n            \"total_pages\": 1,\n            \"links\": []\n        }\n    }\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/exhibitions/search"
      }
    ],
    "filename": "App/Api/v1/Controllers/ExhibitionController.php",
    "groupTitle": "展会",
    "name": "GetExhibitionsSearch"
  },
  {
    "type": "post",
    "url": "/exhibitions/:id/favorites",
    "title": "展会收藏",
    "description": "<p>展会收藏</p>",
    "group": "Exhibition",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 201 Created",
          "type": "json"
        }
      ]
    },
    "filename": "App/Api/v1/Controllers/ExhibitionController.php",
    "groupTitle": "展会",
    "name": "PostExhibitionsIdFavorites"
  },
  {
    "type": "get",
    "url": "/faqs",
    "title": "常见问题",
    "description": "<p>常见问题</p>",
    "group": "Faq",
    "permission": [
      {
        "name": "无"
      }
    ],
    "version": "1.0.0",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n    \"data\": [\n        {\n            \"id\": 1,\n            \"title\": \"常见问题1\",\n            \"content\": \"<p>常见问题内容那就是巴拉巴拉</p>\"\n        },\n        {\n            \"id\": 2,\n            \"title\": \"常见问题2\",\n            \"content\": \"<p>阿达大大大</p>\"\n        }\n    ],\n    \"meta\": {\n        \"pagination\": {\n            \"total\": 2,\n            \"count\": 2,\n            \"per_page\": 15,\n            \"current_page\": 1,\n            \"total_pages\": 1,\n            \"links\": []\n        }\n    }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "App/Api/v1/Controllers/FaqController.php",
    "groupTitle": "常见问题",
    "name": "GetFaqs"
  },
  {
    "type": "delete",
    "url": "/favorites",
    "title": "删除收藏",
    "description": "<p>删除收藏</p>",
    "group": "Favorite",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "favorite_id",
            "description": "<p>模型ID</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "allowedValues": [
              "\"news\"",
              "\"product\"",
              "\"topic\"",
              "\"demand\"",
              "\"supply\"",
              "\"company\"",
              "\"exhibition\"",
              "\"job\""
            ],
            "optional": false,
            "field": "favorite_type",
            "description": "<p>模型</p>"
          }
        ]
      }
    },
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 204 No Content",
          "type": "json"
        }
      ]
    },
    "filename": "App/Api/v1/Controllers/FavoriteController.php",
    "groupTitle": "收藏",
    "name": "DeleteFavorites"
  },
  {
    "type": "get",
    "url": "/favorites/companies/role/:id",
    "title": "收藏的公司",
    "description": "<p>收藏的公司 :id 1//为采购商 2//为供应商 3//为机构/单位</p>",
    "group": "Favorite",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n    \"data\": [\n        {\n            \"id\": 112,\n            \"company_id\": 1,\n            \"name\": \"航运城测试\",\n            \"province\": \"福建省\",\n            \"city\": \"厦门市\",\n            \"area\": \"思明区\",\n            \"addressDetail\": \"HK排比哈哈哈哈他JJ他拒绝离开过来了来了太可怜了啦啦啦啦\",\n            \"telephone\": \"0592-5928529\",\n            \"role\": 1,\n            \"photos\": [\n                \"http://117.29.170.226:8000/storage/companies/2016/12/092247GL7n.png\"\n            ],\n            \"is_validate\": 1,\n            \"is_excellent\": 0\n        }\n    ],\n    \"meta\": {\n        \"pagination\": {\n            \"total\": 1,\n            \"count\": 1,\n            \"per_page\": 15,\n            \"current_page\": 1,\n            \"total_pages\": 1,\n            \"links\": []\n        }\n    }\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/favorites/companies/role/1"
      }
    ],
    "filename": "App/Api/v1/Controllers/FavoriteController.php",
    "groupTitle": "收藏",
    "name": "GetFavoritesCompaniesRoleId"
  },
  {
    "type": "get",
    "url": "/favorites/demands",
    "title": "收藏的需求",
    "description": "<p>收藏的需求</p>",
    "group": "Favorite",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n    \"data\": [\n        {\n            \"id\": 113,\n            \"demand_id\": 1,\n            \"title\": \"我需求质量好的袋子\",\n            \"quantity\": 1000,\n            \"unit\": 5,\n            \"images\": [\n                \"http://stone.dev/uploads/products/2016/11/165305Y37a.png\"\n            ],\n            \"is_excellent\": 0\n        }\n    ],\n    \"meta\": {\n        \"pagination\": {\n            \"total\": 1,\n            \"count\": 1,\n            \"per_page\": 15,\n            \"current_page\": 1,\n            \"total_pages\": 1,\n            \"links\": []\n        }\n    }\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/favorites/demands"
      }
    ],
    "filename": "App/Api/v1/Controllers/FavoriteController.php",
    "groupTitle": "收藏",
    "name": "GetFavoritesDemands"
  },
  {
    "type": "get",
    "url": "/favorites/exhibitions",
    "title": "收藏的展会",
    "description": "<p>收藏的展会</p>",
    "group": "Favorite",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n    \"data\": [\n        {\n            \"id\": 1,\n            \"exhibitions_id\": 2,\n            \"title\": \"有一个展会\",\n            \"address\": \"xiamen\",\n            \"telephone\": \"05925910000\",\n            \"image\": \"/storage/images/00425874a34ae1fd522f96c753ee2b2b.jpg\"\n        }\n    ],\n    \"meta\": {\n        \"pagination\": {\n            \"total\": 1,\n            \"count\": 1,\n            \"per_page\": 15,\n            \"current_page\": 1,\n            \"total_pages\": 1,\n            \"links\": []\n        }\n    }\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/favorites/exhibitions"
      }
    ],
    "filename": "App/Api/v1/Controllers/FavoriteController.php",
    "groupTitle": "收藏",
    "name": "GetFavoritesExhibitions"
  },
  {
    "type": "get",
    "url": "/favorites/jobs",
    "title": "收藏的招聘",
    "description": "<p>收藏的招聘</p>",
    "group": "Favorite",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n    \"data\": [\n        {\n            \"id\": 1,\n            \"company_id\": 2,\n            \"job\": \"销售代表\",\n            \"total\": \"10人\",\n            \"education\": \"本科大学\",\n            \"experience\": \"2-3年\",\n            \"minsalary\": \"50000\",\n            \"content\": \"<p>要求就是不要命</p>\"\n        }\n    ],\n    \"meta\": {\n        \"pagination\": {\n            \"total\": 1,\n            \"count\": 1,\n            \"per_page\": 15,\n            \"current_page\": 1,\n            \"total_pages\": 1,\n            \"links\": []\n        }\n    }\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/favorites/jobs"
      }
    ],
    "filename": "App/Api/v1/Controllers/FavoriteController.php",
    "groupTitle": "收藏",
    "name": "GetFavoritesJobs"
  },
  {
    "type": "get",
    "url": "/favorites/news",
    "title": "收藏的新闻",
    "description": "<p>收藏的新闻</p>",
    "group": "Favorite",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n    \"data\": [\n        {\n            \"id\": 1,\n            \"news_id\": 2,\n            \"title\": \"sed vel asperiores\",\n            \"subtitle\": \"nisi consectetur ea\",\n            \"image\": \"/storage/images/00425874a34ae1fd522f96c753ee2b2b.jpg\",\n            \"updated_at\": \"2016-11-07 08:23:10\",\n            \"categories\": {\n                \"data\": [\n                    {\n                        \"id\": 1,\n                        \"name\": \"可降解知识\"\n                    }\n                ]\n            }\n        }\n    ],\n    \"meta\": {\n        \"pagination\": {\n            \"total\": 1,\n            \"count\": 1,\n            \"per_page\": 15,\n            \"current_page\": 1,\n            \"total_pages\": 1,\n            \"links\": []\n        }\n    }\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/favorites/news"
      }
    ],
    "filename": "App/Api/v1/Controllers/FavoriteController.php",
    "groupTitle": "收藏",
    "name": "GetFavoritesNews"
  },
  {
    "type": "get",
    "url": "/favorites/products",
    "title": "收藏的产品",
    "description": "<p>收藏的产品</p>",
    "group": "Favorite",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n    \"data\": [\n        {\n            \"id\": 1,\n            \"product_id\": 1,\n            \"title\": \"产品标题\",\n            \"price\": 1.2,\n            \"unit\": 1,\n            \"content\": \"<p>产品很好很好产品很好很好产品很好很好产品很好很好</p>\",\n            \"images\": [\n                \"/uploads/products/2016/11/092739rqKq.png\"\n            ]\n        }\n    ],\n    \"meta\": {\n        \"pagination\": {\n            \"total\": 1,\n            \"count\": 1,\n            \"per_page\": 15,\n            \"current_page\": 1,\n            \"total_pages\": 1,\n            \"links\": []\n        }\n    }\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/favorites/products"
      }
    ],
    "filename": "App/Api/v1/Controllers/FavoriteController.php",
    "groupTitle": "收藏",
    "name": "GetFavoritesProducts"
  },
  {
    "type": "get",
    "url": "/favorites/supplies",
    "title": "收藏的供应",
    "description": "<p>收藏的供应</p>",
    "group": "Favorite",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n    \"data\": [\n        {\n            \"id\": 105,\n            \"supply_id\": 30,\n            \"title\": \"一盒白糖\",\n            \"price\": 50,\n            \"unit\": 5,\n            \"images\": [\n                \"http://117.29.170.226:8000/storage/companies/2016/12/062736s8QD.png\"\n            ],\n            \"content\": \"这是一箱白糖\",\n            \"is_excellent\": 0\n        }\n    ],\n    \"meta\": {\n        \"pagination\": {\n            \"total\": 1,\n            \"count\": 1,\n            \"per_page\": 15,\n            \"current_page\": 1,\n            \"total_pages\": 1,\n            \"links\": []\n        }\n    }\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/favorites/supplies"
      }
    ],
    "filename": "App/Api/v1/Controllers/FavoriteController.php",
    "groupTitle": "收藏",
    "name": "GetFavoritesSupplies"
  },
  {
    "type": "get",
    "url": "/favorites/topics",
    "title": "收藏的帖子",
    "description": "<p>收藏的帖子</p>",
    "group": "Favorite",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n    \"data\": [\n        {\n            \"id\": 1,\n            \"topic_id\": 2,\n            \"category_id\": 2,\n            \"title\": \"Laravel 5.3 中文文档翻译完成\",\n            \"content\": \"<p style=\\\"box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; line-height: 30px; color: rgb(82, 82, 82); font-family: NotoSansHans-Regular, AvenirNext-Regular, arial, \\\" hiragino=\\\"\\\" sans=\\\"\\\" microsoft=\\\"\\\" wenquanyi=\\\"\\\" micro=\\\"\\\" white-space:=\\\"\\\" background-color:=\\\"\\\"><img src=\\\"https://dn-phphub.qbox.me/uploads/images/201608/24/1/IEQ4Xir8sH.jpg\\\" alt=\\\"\\\" data-type=\\\"image\\\" style=\\\"box-sizing: border-box; border: 1px solid rgb(221, 221, 221); vertical-align: middle; max-width: 100%; box-shadow: rgb(204, 204, 204) 0px 0px 30px; margin-bottom: 30px; margin-top: 10px;\\\"/></p><p style=\\\"box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; line-height: 30px; color: rgb(82, 82, 82); font-family: NotoSansHans-Regular, AvenirNext-Regular, arial, \\\" hiragino=\\\"\\\" sans=\\\"\\\" microsoft=\\\"\\\" wenquanyi=\\\"\\\" micro=\\\"\\\" white-space:=\\\"\\\" background-color:=\\\"\\\">文档地址在此：<a href=\\\"https://laravel-china.org/docs/5.3\\\" style=\\\"box-sizing: border-box; background: transparent; color: rgb(5, 161, 162); text-decoration: none;\\\">https://laravel-china.org/docs/5.3</a></p><p style=\\\"box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; line-height: 30px; color: rgb(82, 82, 82); font-family: NotoSansHans-Regular, AvenirNext-Regular, arial, \\\" hiragino=\\\"\\\" sans=\\\"\\\" microsoft=\\\"\\\" wenquanyi=\\\"\\\" micro=\\\"\\\" white-space:=\\\"\\\" background-color:=\\\"\\\">翻译的召集帖：<a href=\\\"https://laravel-china.org/topics/2752\\\" style=\\\"box-sizing: border-box; background: transparent; color: rgb(5, 161, 162); text-decoration: none;\\\">https://laravel-china.org/topics/2752</a></p><p style=\\\"box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; line-height: 30px; color: rgb(82, 82, 82); font-family: NotoSansHans-Regular, AvenirNext-Regular, arial, \\\" hiragino=\\\"\\\" sans=\\\"\\\" microsoft=\\\"\\\" wenquanyi=\\\"\\\" micro=\\\"\\\" white-space:=\\\"\\\" background-color:=\\\"\\\">参与人员列表：<a href=\\\"https://laravel-china.org/roles/7\\\" style=\\\"box-sizing: border-box; background: transparent; color: rgb(5, 161, 162); text-decoration: none;\\\">Laravel 5.3 译者</a></p><p style=\\\"box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; line-height: 30px; color: rgb(82, 82, 82); font-family: NotoSansHans-Regular, AvenirNext-Regular, arial, \\\" hiragino=\\\"\\\" sans=\\\"\\\" microsoft=\\\"\\\" wenquanyi=\\\"\\\" micro=\\\"\\\" white-space:=\\\"\\\" background-color:=\\\"\\\">项目托管在 Github 上，欢迎提交反馈：<a href=\\\"https://github.com/laravel-china/laravel-docs\\\" style=\\\"box-sizing: border-box; background: transparent; color: rgb(5, 161, 162); text-decoration: none;\\\">https://github.com/laravel-china/laravel-docs</a></p><blockquote style=\\\"box-sizing: border-box; padding: 6px 8px; border-left: 4px solid rgb(221, 221, 221); line-height: 30px; color: rgb(119, 119, 119); background-color: rgb(247, 247, 247); font-family: NotoSansHans-Regular, AvenirNext-Regular, arial, \\\" hiragino=\\\"\\\" sans=\\\"\\\" microsoft=\\\"\\\" wenquanyi=\\\"\\\" micro=\\\"\\\" white-space:=\\\"\\\" margin:=\\\"\\\" 20px=\\\"\\\" 0px=\\\"\\\"><p style=\\\"box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; line-height: 30px;\\\">我代表 Laravel 中文文档的受益者对 可爱的&nbsp;<a href=\\\"https://laravel-china.org/roles/7\\\" style=\\\"box-sizing: border-box; background: transparent; color: rgb(5, 161, 162); text-decoration: none;\\\">Laravel 5.3 译者</a>&nbsp;表示感谢&nbsp;<img title=\\\":beer:\\\" alt=\\\":beer:\\\" class=\\\"emoji\\\" src=\\\"https://dn-phphub.qbox.me/assets/images/emoji/beer.png\\\" align=\\\"absmiddle\\\" style=\\\"box-sizing: border-box; border: 0px; vertical-align: middle; width: 1.6em; display: inline-block; margin-bottom: 0px; margin-top: -5px; margin-left: 5px; max-width: 100%;\\\"/>&nbsp;<img title=\\\":metal:\\\" alt=\\\":metal:\\\" class=\\\"emoji\\\" src=\\\"https://dn-phphub.qbox.me/assets/images/emoji/metal.png\\\" align=\\\"absmiddle\\\" style=\\\"box-sizing: border-box; border: 0px; vertical-align: middle; width: 1.6em; display: inline-block; margin-bottom: 0px; margin-top: -5px; margin-left: 5px; max-width: 100%;\\\"/></p></blockquote><p style=\\\"box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; line-height: 30px; color: rgb(82, 82, 82); font-family: NotoSansHans-Regular, AvenirNext-Regular, arial, \\\" hiragino=\\\"\\\" sans=\\\"\\\" microsoft=\\\"\\\" wenquanyi=\\\"\\\" micro=\\\"\\\" white-space:=\\\"\\\" background-color:=\\\"\\\"><img src=\\\"https://dn-phphub.qbox.me/uploads/images/201610/19/1/F9kV4goXoU.png\\\" alt=\\\"\\\" data-type=\\\"image\\\" style=\\\"box-sizing: border-box; border: 1px solid rgb(221, 221, 221); vertical-align: middle; max-width: 100%; box-shadow: rgb(204, 204, 204) 0px 0px 30px; margin-bottom: 30px; margin-top: 10px;\\\"/></p><p><br/></p>\",\n            \"reply_count\": 4,\n            \"vote_count\": 5,\n            \"vote_up\": 0,\n            \"vote_down\": 0,\n            \"updated_at\": \"2016-11-07\",\n            \"user\": {\n                \"data\": {\n                    \"id\": 2,\n                    \"username\": \"user\",\n                    \"mobile\": \"13113113111\",\n                    \"email\": \"user@user.com\",\n                    \"avatar\": \"http://stone.dev/uploads/avatars/default/medium.png\",\n                    \"created_at\": \"2016-11-02 15:57:24\"\n                }\n            }\n        }\n    ],\n    \"meta\": {\n        \"pagination\": {\n            \"total\": 1,\n            \"count\": 1,\n            \"per_page\": 15,\n            \"current_page\": 1,\n            \"total_pages\": 1,\n            \"links\": []\n        }\n    }\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/favorites/topics"
      }
    ],
    "filename": "App/Api/v1/Controllers/FavoriteController.php",
    "groupTitle": "收藏",
    "name": "GetFavoritesTopics"
  },
  {
    "type": "post",
    "url": "/feedbacks",
    "title": "提交反馈",
    "description": "<p>提交反馈</p>",
    "group": "Feedback",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "content",
            "description": "<p>反馈内容</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 201 Created",
          "type": "json"
        }
      ]
    },
    "filename": "App/Api/v1/Controllers/FeedbackController.php",
    "groupTitle": "反馈",
    "name": "PostFeedbacks"
  },
  {
    "type": "get",
    "url": "/home",
    "title": "首页",
    "description": "<p>首页（包含轮播图、新闻、展会）</p>",
    "group": "Homepage",
    "permission": [
      {
        "name": "无"
      }
    ],
    "version": "1.0.0",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n    \"data\": {\n        \"banners\": [\n            {\n                \"id\": 9,\n                \"title\": \"我是首页轮播图3\",\n                \"image_url\": \"http://stone.dev/storage/banners/f53014b75d5d55c2509a462581f49433.png\",\n                \"order\": 9,\n                \"link\": \"\",\n                \"published_from\": \"2016-11-30 04:02:05\",\n                \"published_to\": \"2016-11-30 04:02:05\"\n            },\n            {\n                \"id\": 4,\n                \"title\": \"我是首页轮播\",\n                \"image_url\": \"http://stone.dev/storage/banners/a766a4fb33a03664caaad1017937f404.png\",\n                \"order\": 4,\n                \"link\": \"\",\n                \"published_from\": \"2016-11-30 11:30:35\",\n                \"published_to\": \"2017-01-31 11:30:35\"\n            },\n            {\n                \"id\": 3,\n                \"title\": \"我是首页轮播\",\n                \"image_url\": \"http://stone.dev/storage/banners/f53014b75d5d55c2509a462581f49433.png\",\n                \"order\": 3,\n                \"link\": \"\",\n                \"published_from\": \"2016-11-30 11:30:15\",\n                \"published_to\": \"2016-12-31 11:30:15\"\n            }\n        ],\n        \"news\": {\n            \"id\": 13,\n            \"title\": \"基于RESTful API 怎么设计用户权限控制？\",\n            \"subtitle\": \"有人说，每个人都是平等的；\\r\\n也有人说，人生来就是不平等的；\\r\\n在人类社会中，并没有绝对的公平，\\r\\n一件事，并不是所有人都能去做；\\r\\n一样物，并不是所有人都能够拥有。\",\n            \"image\": \"/storage/images/00425874a34ae1fd522f96c753ee2b2b.jpg\",\n            \"updated_at\": \"2016-11-14 06:45:31\",\n            \"is_excellent\": 1,\n            \"is_top\": 1,\n            \"categories\": {\n                \"data\": [\n                    {\n                        \"id\": 1,\n                        \"name\": \"可降解知识\"\n                    },\n                    {\n                        \"id\": 2,\n                        \"name\": \"高分子知识\"\n                    },\n                    {\n                        \"id\": 3,\n                        \"name\": \"国内市场动态\"\n                    }\n                ]\n            }\n        },\n        \"exhibition\": {\n            \"id\": 1,\n            \"title\": \"有一个展会\",\n            \"address\": \"xiamen\",\n            \"telephone\": \"05925910000\",\n            \"image\": \"/storage/images/00425874a34ae1fd522f96c753ee2b2b.jpg\",\n            \"is_excellent\": 1,\n            \"is_top\": 1\n        }\n    }\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/home"
      }
    ],
    "filename": "App/Api/v1/Controllers/HomepageController.php",
    "groupTitle": "首页",
    "name": "GetHome"
  },
  {
    "type": "get",
    "url": "/news",
    "title": "新闻列表",
    "description": "<p>新闻列表</p>",
    "group": "News",
    "permission": [
      {
        "name": "无"
      }
    ],
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "size": "0,1,2,3,4,5,6",
            "optional": false,
            "field": "categories",
            "description": "<p>//0为全部或不传也可以</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n    \"data\": [\n        {\n            \"id\": 1,\n            \"title\": \"sed vel asperiores\",\n            \"subtitle\": \"nisi consectetur ea\",\n            \"image\": \"/storage/images/00425874a34ae1fd522f96c753ee2b2b.jpg\",\n            \"updated_at\": \"2016-11-02 15:59:21\"\n        },\n        {\n            \"id\": 6,\n            \"title\": \"aut qui explicabo\",\n            \"subtitle\": \"esse iste aut\",\n            \"image\": \"\",\n            \"updated_at\": \"2016-10-31 19:47:55\"\n        },\n        {\n            \"id\": 13,\n            \"title\": \"基于RESTful API 怎么设计用户权限控制？\",\n            \"subtitle\": \"有人说，每个人都是平等的；\\r\\n也有人说，人生来就是不平等的；\\r\\n在人类社会中，并没有绝对的公平，\\r\\n一件事，并不是所有人都能去做；\\r\\n一样物，并不是所有人都能够拥有。\",\n            \"image\": \"/storage/images/00425874a34ae1fd522f96c753ee2b2b.jpg\",\n            \"updated_at\": \"2016-11-02 15:57:41\"\n        }\n    ],\n    \"meta\": {\n        \"pagination\": {\n            \"total\": 3,\n            \"count\": 3,\n            \"per_page\": 15,\n            \"current_page\": 1,\n            \"total_pages\": 1,\n            \"links\": []\n        }\n    }\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/news"
      }
    ],
    "filename": "App/Api/v1/Controllers/NewsController.php",
    "groupTitle": "新闻",
    "name": "GetNews"
  },
  {
    "type": "get",
    "url": "/news/banner",
    "title": "新闻轮播图",
    "description": "<p>新闻轮播图</p>",
    "group": "News",
    "permission": [
      {
        "name": "无"
      }
    ],
    "version": "1.0.0",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n{\n           \"data\": [\n               {\n                   \"id\": 1,\n                   \"title\": \"我是标题1\",\n                   \"image_url\": \"/storage/banners/f53014b75d5d55c2509a462581f49433.png\",\n                   \"order\": 1,\n                   \"link\": \"\",\n                   \"published_from\": \"2016-11-30 11:29:24\",\n                   \"published_to\": \"2016-12-31 11:29:24\"\n               },\n               {\n                   \"id\": 2,\n                   \"title\": \"我是标题2\",\n                   \"image_url\": \"/storage/banners/a766a4fb33a03664caaad1017937f404.png\",\n                   \"order\": 2,\n                   \"link\": \"\",\n                   \"published_from\": \"2016-11-30 11:29:53\",\n                   \"published_to\": \"2016-12-31 11:29:53\"\n               }\n           ]\n       }",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/news/banner"
      }
    ],
    "filename": "App/Api/v1/Controllers/NewsController.php",
    "groupTitle": "新闻",
    "name": "GetNewsBanner"
  },
  {
    "type": "get",
    "url": "/news/categories",
    "title": "新闻分类",
    "description": "<p>新闻分类</p>",
    "group": "News",
    "permission": [
      {
        "name": "无"
      }
    ],
    "version": "1.0.0",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n   {\n       \"data\": [\n           {\n               \"id\": 1,\n               \"name\": \"可降解知识\"\n           },\n           {\n               \"id\": 2,\n               \"name\": \"高分子知识\"\n           },\n           {\n               \"id\": 3,\n               \"name\": \"国内市场动态\"\n           },\n           {\n               \"id\": 4,\n               \"name\": \"国外市场动态\"\n           },\n           {\n               \"id\": 5,\n               \"name\": \"行业新闻\"\n           },\n           {\n               \"id\": 6,\n               \"name\": \"法律法规\"\n           }\n       ]\n   }",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/news/categories"
      }
    ],
    "filename": "App/Api/v1/Controllers/NewsController.php",
    "groupTitle": "新闻",
    "name": "GetNewsCategories"
  },
  {
    "type": "get",
    "url": "/news/:id",
    "title": "新闻详情",
    "description": "<p>新闻详情</p>",
    "group": "News",
    "permission": [
      {
        "name": "无"
      }
    ],
    "version": "1.0.0",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "     HTTP/1.1 200 OK\n{\n   \"data\": {\n      \"id\": 1,\n     \"title\": \"sed vel asperiores\",\n     \"subtitle\": \"nisi consectetur ea\",\n     \"content\": \"<p>Ut sit dolore culpa minima. Voluptas corrupti ullam occaecati praesentium quia enim. Dolor incidunt aut repellendus.</p>\",\n     \"image\": \"/storage/images/00425874a34ae1fd522f96c753ee2b2b.jpg\",\n     \"created_at\": \"2016-10-31 19:38:48\"\n     }\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/news/1"
      }
    ],
    "filename": "App/Api/v1/Controllers/NewsController.php",
    "groupTitle": "新闻",
    "name": "GetNewsId"
  },
  {
    "type": "get",
    "url": "/news/search",
    "title": "新闻搜索",
    "description": "<p>新闻搜索</p>",
    "group": "News",
    "permission": [
      {
        "name": "无"
      }
    ],
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "q",
            "description": "<p>搜索关键字</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n    \"data\": [\n        {\n            \"id\": 1,\n            \"title\": \"sed vel asperiores\",\n            \"subtitle\": \"nisi consectetur ea\",\n            \"image\": \"http://stone.dev/storage/images/00425874a34ae1fd522f96c753ee2b2b.jpg\",\n            \"updated_at\": \"2016-11-15 07:12:40\",\n            \"is_excellent\": 0,\n            \"is_top\": 0,\n            \"categories\": {\n                \"data\": [\n                    {\n                        \"id\": 1,\n                        \"name\": \"可降解知识\"\n                    }\n                ]\n            }\n        },\n        {\n            \"id\": 3,\n            \"title\": \"eos molestiae aut\",\n            \"subtitle\": \"eveniet dolorem cum\",\n            \"image\": \"http://stone.dev/storage/images/6f9326f09fe1cb83d01c74d5cce7cc41.jpg\",\n            \"updated_at\": \"2016-11-11 05:55:59\",\n            \"is_excellent\": 0,\n            \"is_top\": 0,\n            \"categories\": {\n                \"data\": []\n            }\n        }\n    ],\n    \"meta\": {\n        \"pagination\": {\n            \"total\": 2,\n            \"count\": 2,\n            \"per_page\": 15,\n            \"current_page\": 1,\n            \"total_pages\": 1,\n            \"links\": []\n        }\n    }\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/news/search"
      }
    ],
    "filename": "App/Api/v1/Controllers/NewsController.php",
    "groupTitle": "新闻",
    "name": "GetNewsSearch"
  },
  {
    "type": "post",
    "url": "/news/:id/favorites",
    "title": "新闻收藏",
    "description": "<p>新闻收藏</p>",
    "group": "News",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 201 Created",
          "type": "json"
        }
      ]
    },
    "filename": "App/Api/v1/Controllers/NewsController.php",
    "groupTitle": "新闻",
    "name": "PostNewsIdFavorites"
  },
  {
    "type": "get",
    "url": "/notifications",
    "title": "通知",
    "description": "<p>通知</p>",
    "group": "Notify",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n    \"data\": [\n        {\n            \"id\": 104,\n            \"title\": \"系统通知\",\n            \"notification_id\": 26,\n            \"notification_type\": \"App\\\\Models\\\\Join\",\n            \"message\": \"user • 申请认证，请您及时处理。\",\n            \"sender\": 2,\n            \"read_at\": \"\",\n            \"created_at\": \"2016-11-14 04:02:52\"\n        },\n        {\n            \"id\": 96,\n            \"title\": \"赞了你的回复\",\n            \"notification_id\": 1,\n            \"notification_type\": \"App\\\\Models\\\\Reply\",\n            \"message\": \"user • 赞了你的回复\",\n            \"sender\": 2,\n            \"read_at\": \"\",\n            \"created_at\": \"2016-11-14 03:26:29\"\n        },\n        {\n            \"id\": 95,\n            \"title\": \"赞了你的主题\",\n            \"notification_id\": 4,\n            \"notification_type\": \"App\\\\Models\\\\Topic\",\n            \"message\": \"user • 赞了你的主题 • 我再发布了一个话题\",\n            \"sender\": 2,\n            \"read_at\": \"\",\n            \"created_at\": \"2016-11-14 03:18:19\"\n        },\n        {\n            \"id\": 57,\n            \"title\": \"系统消息\",\n            \"notification_id\": 5,\n            \"notification_type\": \"App\\\\Models\\\\News\",\n            \"message\": \"啊大大\",\n            \"sender\": \"\",\n            \"read_at\": \"\",\n            \"created_at\": \"2016-11-11 02:15:00\"\n        },\n        {\n            \"id\": 56,\n            \"title\": \"系统消息\",\n            \"notification_id\": 5,\n            \"notification_type\": \"App\\\\Models\\\\News\",\n            \"message\": \"啊大大\",\n            \"sender\": \"\",\n            \"read_at\": \"\",\n            \"created_at\": \"2016-11-11 02:15:00\"\n        },\n        {\n            \"id\": 55,\n            \"title\": \"系统消息\",\n            \"notification_id\": 5,\n            \"notification_type\": \"App\\\\Models\\\\News\",\n            \"message\": \"啊大大\",\n            \"sender\": \"\",\n            \"read_at\": \"\",\n            \"created_at\": \"2016-11-11 02:15:00\"\n        },\n        {\n            \"id\": 54,\n            \"title\": \"系统消息\",\n            \"notification_id\": 5,\n            \"notification_type\": \"App\\\\Models\\\\News\",\n            \"message\": \"我现在要给所有用户发一条内部消息\",\n            \"sender\": \"\",\n            \"read_at\": \"\",\n            \"created_at\": \"2016-11-11 02:15:00\"\n        },\n        {\n            \"id\": 53,\n            \"title\": \"系统消息\",\n            \"notification_id\": 4,\n            \"notification_type\": \"App\\\\Models\\\\News\",\n            \"message\": \"我现在要给所有用户发一条内部消息\",\n            \"sender\": \"\",\n            \"read_at\": \"\",\n            \"created_at\": \"2016-11-11 02:15:00\"\n        },\n        {\n            \"id\": 6,\n            \"title\": \"系统消息\",\n            \"notification_id\": 3,\n            \"notification_type\": \"App\\\\Models\\\\Topic\",\n            \"message\": \"我推送了什么消息吗\",\n            \"sender\": \"\",\n            \"read_at\": \"\",\n            \"created_at\": \"2016-11-10 11:02:43\"\n        },\n        {\n            \"id\": 5,\n            \"title\": \"系统消息\",\n            \"notification_id\": 2,\n            \"notification_type\": \"App\\\\Models\\\\Topic\",\n            \"message\": \"我推送论坛消息\",\n            \"sender\": \"\",\n            \"read_at\": \"\",\n            \"created_at\": \"2016-11-10 11:02:43\"\n        },\n        {\n            \"id\": 4,\n            \"title\": \"系统消息\",\n            \"notification_id\": 1,\n            \"notification_type\": \"App\\\\Models\\\\Topic\",\n            \"message\": \"我是推送消息\",\n            \"sender\": \"\",\n            \"read_at\": \"2016-11-10 11:04:48\",\n            \"created_at\": \"2016-11-10 11:02:43\"\n        }\n    ]\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/notifications"
      }
    ],
    "filename": "App/Api/v1/Controllers/NotificationController.php",
    "groupTitle": "通知",
    "name": "GetNotifications"
  },
  {
    "type": "post",
    "url": "/notifications/",
    "title": "消息回调",
    "description": "<p>消息回调</p>",
    "group": "Notify",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "notification_id",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "notification_type",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "created_at",
            "description": ""
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 201 Created",
          "type": "json"
        }
      ]
    },
    "filename": "App/Api/v1/Controllers/NotificationController.php",
    "groupTitle": "通知",
    "name": "PostNotifications"
  },
  {
    "type": "post",
    "url": "/notifications/:id",
    "title": "标记已读",
    "description": "<p>标记已读</p>",
    "group": "Notify",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 204 No Content",
          "type": "json"
        }
      ]
    },
    "filename": "App/Api/v1/Controllers/NotificationController.php",
    "groupTitle": "通知",
    "name": "PostNotificationsId"
  },
  {
    "type": "delete",
    "url": "/products/:id",
    "title": "删除产品",
    "description": "<p>删除产品 :id 需要删除产品的ID</p>",
    "group": "Product",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 204 No Content",
          "type": "json"
        }
      ]
    },
    "filename": "App/Api/v1/Controllers/ProductController.php",
    "groupTitle": "产品",
    "name": "DeleteProductsId"
  },
  {
    "type": "get",
    "url": "/products",
    "title": "产品列表",
    "description": "<p>产品列表</p>",
    "group": "Product",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n    \"data\": [\n        {\n            \"id\": 1,\n            \"title\": \"产品标题\",\n            \"price\": 1.2,\n            \"unit\": 1,\n            \"content\": \"<p>产品很好很好产品很好很好产品很好很好产品很好很好</p>\",\n            \"images\": [\n                \"/uploads/products/2016/11/092739rqKq.png\"\n            ]\n        },\n        {\n            \"id\": 2,\n            \"title\": \"我有袋子100箱\",\n            \"price\": 100,\n            \"unit\": 5,\n            \"content\": \"<p style=\\\"margin-top: 0px; margin-bottom: 0px; text-rendering: optimizeLegibility; font-feature-settings: &#39;kern&#39; 1; font-kerning: normal; color: rgb(51, 51, 51); font-family: &quot;Arial Normal&quot;, Arial; font-size: 18px; white-space: normal;\\\">加工定制 是</p><p style=\\\"margin-top: 0px; margin-bottom: 0px; text-rendering: optimizeLegibility; font-feature-settings: &#39;kern&#39; 1; font-kerning: normal; color: rgb(51, 51, 51); font-family: &quot;Arial Normal&quot;, Arial; font-size: 18px; white-space: normal;\\\">用途 通用包装</p><p style=\\\"margin-top: 0px; margin-bottom: 0px; text-rendering: optimizeLegibility; font-feature-settings: &#39;kern&#39; 1; font-kerning: normal; color: rgb(51, 51, 51); font-family: &quot;Arial Normal&quot;, Arial; font-size: 18px; white-space: normal;\\\">底面侧面 无底无侧</p><p style=\\\"margin-top: 0px; margin-bottom: 0px; text-rendering: optimizeLegibility; font-feature-settings: &#39;kern&#39; 1; font-kerning: normal; color: rgb(51, 51, 51); font-family: &quot;Arial Normal&quot;, Arial; font-size: 18px; white-space: normal;\\\">供货类型 可定制</p><p style=\\\"margin-top: 0px; margin-bottom: 0px; text-rendering: optimizeLegibility; font-feature-settings: &#39;kern&#39; 1; font-kerning: normal; color: rgb(51, 51, 51); font-family: &quot;Arial Normal&quot;, Arial; font-size: 18px; white-space: normal;\\\">规格 400*300（mm*mm）</p><p style=\\\"margin-top: 0px; margin-bottom: 0px; text-rendering: optimizeLegibility; font-feature-settings: &#39;kern&#39; 1; font-kerning: normal; color: rgb(51, 51, 51); font-family: &quot;Arial Normal&quot;, Arial; font-size: 18px; white-space: normal;\\\">加印LOGO 可以</p><p style=\\\"margin-top: 0px; margin-bottom: 0px; text-rendering: optimizeLegibility; font-feature-settings: &#39;kern&#39; 1; font-kerning: normal; color: rgb(51, 51, 51); font-family: &quot;Arial Normal&quot;, Arial; font-size: 18px; white-space: normal;\\\">款式 手提袋</p><p style=\\\"margin-top: 0px; margin-bottom: 0px; text-rendering: optimizeLegibility; font-feature-settings: &#39;kern&#39; 1; font-kerning: normal; color: rgb(51, 51, 51); font-family: &quot;Arial Normal&quot;, Arial; font-size: 18px; white-space: normal;\\\">颜色 米白</p><p style=\\\"margin-top: 0px; margin-bottom: 0px; text-rendering: optimizeLegibility; font-feature-settings: &#39;kern&#39; 1; font-kerning: normal; color: rgb(51, 51, 51); font-family: &quot;Arial Normal&quot;, Arial; font-size: 18px; white-space: normal;\\\">印刷工艺 丝印</p><p style=\\\"margin-top: 0px; margin-bottom: 0px; text-rendering: optimizeLegibility; font-feature-settings: &#39;kern&#39; 1; font-kerning: normal; color: rgb(51, 51, 51); font-family: &quot;Arial Normal&quot;, Arial; font-size: 18px; white-space: normal;\\\">自重 285（g）</p><p style=\\\"margin-top: 0px; margin-bottom: 0px; text-rendering: optimizeLegibility; font-feature-settings: &#39;kern&#39; 1; font-kerning: normal; color: rgb(51, 51, 51); font-family: &quot;Arial Normal&quot;, Arial; font-size: 18px; white-space: normal;\\\">品牌 Martina</p><p style=\\\"margin-top: 0px; margin-bottom: 0px; text-rendering: optimizeLegibility; font-feature-settings: &#39;kern&#39; 1; font-kerning: normal; color: rgb(51, 51, 51); font-family: &quot;Arial Normal&quot;, Arial; font-size: 18px; white-space: normal;\\\">是否有现货 有</p><p><br/></p>\",\n            \"images\": [\n                \"/uploads/products/2016/11/165204E76X.png\"\n            ]\n        }\n    ],\n    \"meta\": {\n        \"pagination\": {\n            \"total\": 2,\n            \"count\": 2,\n            \"per_page\": 15,\n            \"current_page\": 1,\n            \"total_pages\": 1,\n            \"links\": []\n        }\n    }\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/products"
      }
    ],
    "filename": "App/Api/v1/Controllers/ProductController.php",
    "groupTitle": "产品",
    "name": "GetProducts"
  },
  {
    "type": "get",
    "url": "/products/:id",
    "title": "产品详情",
    "description": "<p>产品详情 :id为产品ID</p>",
    "group": "Product",
    "permission": [
      {
        "name": "无"
      }
    ],
    "version": "1.0.0",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n    \"data\": {\n        \"id\": 1,\n        \"title\": \"产品标题\",\n        \"province\": \"海南省\",\n        \"city\": \"三沙市\",\n        \"area\": \"中沙群岛的岛礁及其海域\",\n        \"addressDetail\": \"\",\n        \"telephone\": \"0592-5928529\",\n        \"price\": 1.2,\n        \"unit\": 1,\n        \"content\": \"<p>产品很好很好产品很好很好产品很好很好产品很好很好</p>\",\n        \"images\": [\n            \"http://stone.dev/uploads/products/2016/11/092739rqKq.png\"\n        ],\n        \"user\": {\n            \"data\": {\n                \"id\": 3,\n                \"username\": \"来我家\",\n                \"name\": \"新英雄\",\n                \"mobile\": \"13111111112\",\n                \"email\": \"ghsjjshhd\",\n                \"avatar\": {\n                    \"_default\": \"http://192.168.1.41:8000/uploads/avatars/20161117100823_30x30.png\",\n                    \"small\": \"http://192.168.1.41:8000/uploads/avatars/20161117100823_30x30_30x30.png\",\n                    \"medium\": \"http://192.168.1.41:8000/uploads/avatars/20161117100823_30x30_65x65.png\",\n                    \"large\": \"http://192.168.1.41:8000/uploads/avatars/20161117100823_30x30_180x180.png\"\n                },\n                \"created_at\": \"2016-11-02 19:01:58\"\n            }\n        }\n    }\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/products/1"
      }
    ],
    "filename": "App/Api/v1/Controllers/ProductController.php",
    "groupTitle": "产品",
    "name": "GetProductsId"
  },
  {
    "type": "get",
    "url": "/products/search",
    "title": "产品搜索",
    "description": "<p>产品搜索</p>",
    "group": "Product",
    "permission": [
      {
        "name": "无"
      }
    ],
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "q",
            "description": "<p>搜索关键字</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n    \"data\": [\n        {\n            \"id\": 1,\n            \"title\": \"产品标题\",\n            \"price\": 1.2,\n            \"unit\": 1,\n            \"content\": \"<p>产品很好很好产品很好很好产品很好很好产品很好很好</p>\",\n            \"images\": \"http://stone.dev/uploads/products/2016/11/092739rqKq.png\"\n        },\n        {\n            \"id\": 3,\n            \"title\": \"我要更新一个产品4\",\n            \"price\": 1000,\n            \"unit\": 1,\n            \"content\": \"内容就是产品够好你买不买\",\n            \"images\": \"http://stone.dev/uploads/products/2016/11/165204E76X.png\"\n        }\n    ],\n    \"meta\": {\n        \"pagination\": {\n            \"total\": 2,\n            \"count\": 2,\n            \"per_page\": 15,\n            \"current_page\": 1,\n            \"total_pages\": 1,\n            \"links\": []\n        }\n    }\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/products/search"
      }
    ],
    "filename": "App/Api/v1/Controllers/ProductController.php",
    "groupTitle": "产品",
    "name": "GetProductsSearch"
  },
  {
    "type": "PATCH",
    "url": "/products/:id",
    "title": "更新产品",
    "description": "<p>更新产品 :id为产品ID</p>",
    "group": "Product",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>标题</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "price",
            "description": "<p>价格</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "allowedValues": [
              "1",
              "2",
              "3",
              "4",
              "5"
            ],
            "optional": false,
            "field": "unit",
            "description": "<p>单位</p>"
          },
          {
            "group": "Parameter",
            "type": "String[]",
            "optional": false,
            "field": "images[]",
            "description": "<p>图片</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "content",
            "description": "<p>内容</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n    \"data\": {\n        \"id\": 1,\n        \"title\": \"产品标题\",\n        \"address\": \"福建厦门思明\",\n        \"telephone\": \"0592-5928529\",\n        \"price\": 1.2,\n        \"unit\": 1,\n        \"content\": \"<p>产品很好很好产品很好很好产品很好很好产品很好很好</p>\",\n        \"images\": [\n            \"/uploads/products/2016/11/092739rqKq.png\"\n        ]\n    }\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/products/1"
      }
    ],
    "filename": "App/Api/v1/Controllers/ProductController.php",
    "groupTitle": "产品",
    "name": "PatchProductsId"
  },
  {
    "type": "post",
    "url": "/products",
    "title": "发布产品",
    "description": "<p>发布产品 unit代表的单位见顶部(接口说明)</p>",
    "group": "Product",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>标题</p>"
          },
          {
            "group": "Parameter",
            "type": "Int",
            "optional": false,
            "field": "price",
            "description": "<p>价格</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "allowedValues": [
              "1",
              "2",
              "3",
              "4",
              "5"
            ],
            "optional": false,
            "field": "unit",
            "description": "<p>单位</p>"
          },
          {
            "group": "Parameter",
            "type": "String[]",
            "optional": false,
            "field": "images[]",
            "description": "<p>图片</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "content",
            "description": "<p>内容</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 201 Created",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/products"
      }
    ],
    "filename": "App/Api/v1/Controllers/ProductController.php",
    "groupTitle": "产品",
    "name": "PostProducts"
  },
  {
    "type": "delete",
    "url": "/supplies/:id",
    "title": "删除供应",
    "description": "<p>删除供应 :id 需要删除供应的ID</p>",
    "group": "Supply",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 204 No Content",
          "type": "json"
        }
      ]
    },
    "filename": "App/Api/v1/Controllers/SupplyController.php",
    "groupTitle": "供应",
    "name": "DeleteSuppliesId"
  },
  {
    "type": "get",
    "url": "/supplies",
    "title": "供应列表",
    "description": "<p>供应列表</p>",
    "group": "Supply",
    "permission": [
      {
        "name": "无"
      }
    ],
    "version": "1.0.0",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n    \"data\": [\n        {\n            \"id\": 1,\n            \"title\": \"我有100袋包装袋\",\n            \"images\": [\n                \"http://stone.dev/storage/images/00425874a34ae1fd522f96c753ee2b2b.jpg\"\n            ],\n            \"content\": \"<p>我就有这么多包装袋</p>\",\n            \"is_excellent\": 0\n        },\n        {\n            \"id\": 2,\n            \"title\": \"我需求100袋包装袋\",\n            \"images\": [\n                \"http://stone.dev/storage/images/00425874a34ae1fd522f96c753ee2b2b.jpg\"\n            ],\n            \"content\": \"我就需要这么多包装袋\",\n            \"is_excellent\": 1\n        }\n    ],\n    \"meta\": {\n        \"pagination\": {\n            \"total\": 2,\n            \"count\": 2,\n            \"per_page\": 15,\n            \"current_page\": 1,\n            \"total_pages\": 1,\n            \"links\": []\n        }\n    }\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/supplies"
      }
    ],
    "filename": "App/Api/v1/Controllers/SupplyController.php",
    "groupTitle": "供应",
    "name": "GetSupplies"
  },
  {
    "type": "get",
    "url": "/supplies/:id",
    "title": "供应详情",
    "description": "<p>供应详情 :id 供应ID user会员信息 company 公司信息</p>",
    "group": "Supply",
    "permission": [
      {
        "name": "无"
      }
    ],
    "version": "1.0.0",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n    \"data\": {\n        \"id\": 1,\n        \"title\": \"我有100袋包装袋\",\n        \"price\": 100,\n        \"unit\": 1,\n        \"content\": \"<p>我就有这么多包装袋</p>\",\n        \"images\": [\n            \"http://stone.dev/storage/images/00425874a34ae1fd522f96c753ee2b2b.jpg\"\n        ],\n        \"is_excellent\": 0,\n        \"province\": \"北京市\",\n        \"city\": \"北京市\",\n        \"area\": \"石景山区\",\n        \"addressDetail\": \"\",\n        \"user\": {\n            \"data\": {\n                \"id\": 2,\n                \"username\": \"user\",\n                \"name\": \"name\",\n                \"mobile\": \"13113113111\",\n                \"email\": \"user@user.com\",\n                \"avatar\": {\n                    \"_default\": \"\",\n                    \"small\": \"\",\n                    \"medium\": \"\",\n                    \"large\": \"\"\n                },\n                \"created_at\": \"2016-11-02 07:57:24\"\n            }\n        }\n    }\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/supplies/1"
      }
    ],
    "filename": "App/Api/v1/Controllers/SupplyController.php",
    "groupTitle": "供应",
    "name": "GetSuppliesId"
  },
  {
    "type": "get",
    "url": "/supplies/search",
    "title": "供应搜索",
    "description": "<p>供应搜索</p>",
    "group": "Supply",
    "permission": [
      {
        "name": "无"
      }
    ],
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "q",
            "description": "<p>搜索关键字</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n    \"data\": [\n        {\n            \"id\": 2,\n            \"title\": \"我需求100袋包装袋\",\n            \"images\": [\n                \"http://stone.dev/storage/images/00425874a34ae1fd522f96c753ee2b2b.jpg\"\n            ],\n            \"content\": \"我就需要这么多包装袋\",\n            \"is_excellent\": 1\n        }\n    ],\n    \"meta\": {\n        \"pagination\": {\n            \"total\": 1,\n            \"count\": 1,\n            \"per_page\": 15,\n            \"current_page\": 1,\n            \"total_pages\": 1,\n            \"links\": []\n        }\n    }\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/supplies/search"
      }
    ],
    "filename": "App/Api/v1/Controllers/SupplyController.php",
    "groupTitle": "供应",
    "name": "GetSuppliesSearch"
  },
  {
    "type": "PATCH",
    "url": "/supplies/:id",
    "title": "更新供应",
    "description": "<p>更新供应 :id为供应ID</p>",
    "group": "Supply",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>标题</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "price",
            "description": "<p>价格 Number(10,2)</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "allowedValues": [
              "1",
              "2",
              "3",
              "4",
              "5"
            ],
            "optional": false,
            "field": "unit",
            "description": "<p>单位</p>"
          },
          {
            "group": "Parameter",
            "type": "String[]",
            "optional": false,
            "field": "images[]",
            "description": "<p>图片</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "content",
            "description": "<p>内容</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/supplies/1"
      }
    ],
    "filename": "App/Api/v1/Controllers/SupplyController.php",
    "groupTitle": "供应",
    "name": "PatchSuppliesId"
  },
  {
    "type": "post",
    "url": "/supplies",
    "title": "发布供应",
    "description": "<p>发布供应 unit代表的单位见顶部(接口说明)</p>",
    "group": "Supply",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>标题</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "price",
            "description": "<p>价格 Number(10,2)</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "allowedValues": [
              "1",
              "2",
              "3",
              "4",
              "5"
            ],
            "optional": false,
            "field": "unit",
            "description": "<p>单位</p>"
          },
          {
            "group": "Parameter",
            "type": "String[]",
            "optional": false,
            "field": "images[]",
            "description": "<p>图片</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "content",
            "description": "<p>内容</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 201 Created",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/supplies"
      }
    ],
    "filename": "App/Api/v1/Controllers/SupplyController.php",
    "groupTitle": "供应",
    "name": "PostSupplies"
  },
  {
    "type": "post",
    "url": "/supplies/:id/favorites",
    "title": "供应收藏",
    "description": "<p>供应收藏</p>",
    "group": "Supply",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 201 Created",
          "type": "json"
        }
      ]
    },
    "filename": "App/Api/v1/Controllers/SupplyController.php",
    "groupTitle": "供应",
    "name": "PostSuppliesIdFavorites"
  },
  {
    "type": "delete",
    "url": "/topics/:id",
    "title": "删除话题",
    "description": "<p>删除话题 :id 需要删除话题的ID</p>",
    "group": "Topic",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 204 No Content",
          "type": "json"
        }
      ]
    },
    "filename": "App/Api/v1/Controllers/TopicController.php",
    "groupTitle": "论坛",
    "name": "DeleteTopicsId"
  },
  {
    "type": "get",
    "url": "/topics/categories",
    "title": "论坛分类",
    "description": "<p>论坛所有分类</p>",
    "group": "Topic",
    "permission": [
      {
        "name": "无"
      }
    ],
    "version": "1.0.0",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n    \"data\": [\n        {\n            \"id\": 1,\n            \"name\": \"专业知识\"\n        },\n        {\n            \"id\": 2,\n            \"name\": \"活动交友\"\n        },\n        {\n            \"id\": 3,\n            \"name\": \"新闻资讯\"\n        },\n        {\n            \"id\": 4,\n            \"name\": \"商务合作\"\n        },\n        {\n            \"id\": 5,\n            \"name\": \"财经金融\"\n        },\n        {\n            \"id\": 6,\n            \"name\": \"反馈建议\"\n        }\n    ]\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/topics/categories"
      }
    ],
    "filename": "App/Api/v1/Controllers/TopicController.php",
    "groupTitle": "论坛",
    "name": "GetTopicsCategories"
  },
  {
    "type": "get",
    "url": "/topics/categories/:id",
    "title": "话题列表",
    "description": "<p>话题列表 :id 论坛分类ID</p>",
    "group": "Topic",
    "permission": [
      {
        "name": "无"
      }
    ],
    "version": "1.0.0",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n    \"data\": [\n        {\n            \"id\": 6,\n            \"category_id\": 1,\n            \"title\": \"考虑考虑\",\n            \"content\": \"咯聊几句噢噢噢考虑考虑<img src=\\\"http://192.168.1.41:8000/uploads/products/2016/11/1303043WwP.png\\\" alt=\\\"\\\"><u>龙年龙门</u>\",\n            \"reply_count\": 0,\n            \"view_count\": 0,\n            \"vote_count\": 0,\n            \"is_excellent\": 0,\n            \"created_at\": \"2016-11-24 13:03:23\",\n            \"user\": {\n                \"data\": {\n                    \"id\": 3,\n                    \"username\": \"来我家\",\n                    \"name\": \"新英雄\",\n                    \"mobile\": \"13111111112\",\n                    \"email\": \"ghsjjshhd\",\n                    \"avatar\": {\n                        \"_default\": \"http://stone.dev/uploads/avatars/20161117100823_30x30.png\",\n                        \"small\": \"http://stone.dev/uploads/avatars/20161117100823_30x30_30x30.png\",\n                        \"medium\": \"http://stone.dev/uploads/avatars/20161117100823_30x30_65x65.png\",\n                        \"large\": \"http://stone.dev/uploads/avatars/20161117100823_30x30_180x180.png\"\n                    },\n                    \"created_at\": \"2016-11-02 11:01:58\"\n                }\n            },\n            \"replies\": {\n                \"data\": []\n            }\n        },\n        {\n            \"id\": 2,\n            \"category_id\": 1,\n            \"title\": \"我发布了一个话题\",\n            \"content\": \"至2013年04月，全国共有34个省级行政区（其中：4个直辖市、23个省、5个自治区、2个特别行政区），333(不含港澳台)个地级行政区划单位（其中：285个地级市、15个地区、30个自治州、3个盟），2856（不含港澳台）个县级行政区划单位（其中：860个市辖区、368个县级市、1453个县、117自治县、49个旗、3个自治旗、1个特区、1个林区），41658（不含港澳台）个乡级行政区划单位（其中：2个区公所、7194个街道、19683个镇、13587个乡、1085个民族乡、106个苏木、1个民族苏木）。662238（不含港澳台）个村级行政单位（包括街道办事处）（省以下行政区划单位统计不包括港澳台）  经常沿用华东、华北、华南、华中、东北、西南、西北七大区的地理分布的说法，具体如下：华北（北京、天津、河北、山西、内蒙古）、华东（上海、山东、江苏、安徽、江西、浙江、福建、台湾）、华中（湖北、湖南、河南）、华南（广东、广西、海南、香港、澳门）、西南（重庆、四川、贵州、云南、西藏）、西北（陕西、甘肃、宁夏、新疆、青海）、东北（黑龙江、吉林、辽宁）（省以下行政区划单位统计不包括台湾） 。\",\n            \"reply_count\": 0,\n            \"view_count\": 9,\n            \"vote_count\": 2,\n            \"is_excellent\": 0,\n            \"created_at\": \"2016-11-03 03:58:13\",\n            \"user\": {\n                \"data\": {\n                    \"id\": 2,\n                    \"username\": \"user\",\n                    \"name\": \"name\",\n                    \"mobile\": \"13113113111\",\n                    \"email\": \"user@user.com\",\n                    \"avatar\": {\n                        \"_default\": \"\",\n                        \"small\": \"\",\n                        \"medium\": \"\",\n                        \"large\": \"\"\n                    },\n                    \"created_at\": \"2016-11-02 07:57:24\"\n                }\n            },\n            \"replies\": {\n                \"data\": []\n            }\n        },\n        {\n            \"id\": 4,\n            \"category_id\": 1,\n            \"title\": \"我再发布了一个话题\",\n            \"content\": \"至2013年04月，全国共有34个省级行政区（其中：4个直辖市、23个省、5个自治区、2个特别行政区），333(不含港澳台)个地级行政区划单位（其中：285个地级市、15个地区、30个自治州、3个盟），2856（不含港澳台）个县级行政区划单位（其中：860个市辖区、368个县级市、1453个县、117自治县、49个旗、3个自治旗、1个特区、1个林区），41658（不含港澳台）个乡级行政区划单位（其中：2个区公所、7194个街道、19683个镇、13587个乡、1085个民族乡、106个苏木、1个民族苏木）。662238（不含港澳台）个村级行政单位（包括街道办事处）（省以下行政区划单位统计不包括港澳台）  经常沿用华东、华北、华南、华中、东北、西南、西北七大区的地理分布的说法，具体如下：华北（北京、天津、河北、山西、内蒙古）、华东（上海、山东、江苏、安徽、江西、浙江、福建、台湾）、华中（湖北、湖南、河南）、华南（广东、广西、海南、香港、澳门）、西南（重庆、四川、贵州、云南、西藏）、西北（陕西、甘肃、宁夏、新疆、青海）、东北（黑龙江、吉林、辽宁）（省以下行政区划单位统计不包括台湾） 。\",\n            \"reply_count\": 0,\n            \"view_count\": 0,\n            \"vote_count\": 2,\n            \"is_excellent\": 0,\n            \"created_at\": \"2016-11-03 06:01:26\",\n            \"user\": {\n                \"data\": {\n                    \"id\": 45,\n                    \"username\": \"Jervis\",\n                    \"name\": \"纪栋梁\",\n                    \"mobile\": \"15759268225\",\n                    \"email\": \"751385816@qq.com\",\n                    \"avatar\": {\n                        \"_default\": \"http://stone.dev/uploads/avatars/20161123060656.png\",\n                        \"small\": \"http://stone.dev/uploads/avatars/20161123060656_30x30.png\",\n                        \"medium\": \"http://stone.dev/uploads/avatars/20161123060656_65x65.png\",\n                        \"large\": \"http://stone.dev/uploads/avatars/20161123060656_180x180.png\"\n                    },\n                    \"created_at\": \"2016-11-10 18:47:56\"\n                }\n            },\n            \"replies\": {\n                \"data\": []\n            }\n        },\n        {\n            \"id\": 3,\n            \"category_id\": 1,\n            \"title\": \"我又发布了一个话题\",\n            \"content\": \"至2013年04月，全国共有34个省级行政区（其中：4个直辖市、23个省、5个自治区、2个特别行政区），333(不含港澳台)个地级行政区划单位（其中：285个地级市、15个地区、30个自治州、3个盟），2856（不含港澳台）个县级行政区划单位（其中：860个市辖区、368个县级市、1453个县、117自治县、49个旗、3个自治旗、1个特区、1个林区），41658（不含港澳台）个乡级行政区划单位（其中：2个区公所、7194个街道、19683个镇、13587个乡、1085个民族乡、106个苏木、1个民族苏木）。662238（不含港澳台）个村级行政单位（包括街道办事处）（省以下行政区划单位统计不包括港澳台）  经常沿用华东、华北、华南、华中、东北、西南、西北七大区的地理分布的说法，具体如下：华北（北京、天津、河北、山西、内蒙古）、华东（上海、山东、江苏、安徽、江西、浙江、福建、台湾）、华中（湖北、湖南、河南）、华南（广东、广西、海南、香港、澳门）、西南（重庆、四川、贵州、云南、西藏）、西北（陕西、甘肃、宁夏、新疆、青海）、东北（黑龙江、吉林、辽宁）（省以下行政区划单位统计不包括台湾） 。\",\n            \"reply_count\": 0,\n            \"view_count\": 0,\n            \"vote_count\": 0,\n            \"is_excellent\": 0,\n            \"created_at\": \"2016-11-03 05:52:50\",\n            \"user\": {\n                \"data\": {\n                    \"id\": 1,\n                    \"username\": \"admin\",\n                    \"name\": \"管理员\",\n                    \"mobile\": \"13111111111\",\n                    \"email\": \"admin@admin.com\",\n                    \"avatar\": {\n                        \"_default\": \"http://stone.dev/uploads/avatars/20161107085531.png\",\n                        \"small\": \"http://stone.dev/uploads/avatars/20161107085531_30x30.png\",\n                        \"medium\": \"http://stone.dev/uploads/avatars/20161107085531_65x65.png\",\n                        \"large\": \"http://stone.dev/uploads/avatars/20161107085531_180x180.png\"\n                    },\n                    \"created_at\": \"2016-11-02 07:57:24\"\n                }\n            },\n            \"replies\": {\n                \"data\": []\n            }\n        }\n    ],\n    \"meta\": {\n        \"pagination\": {\n            \"total\": 4,\n            \"count\": 4,\n            \"per_page\": 15,\n            \"current_page\": 1,\n            \"total_pages\": 1,\n            \"links\": []\n        }\n    }\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/topics/categories/1"
      }
    ],
    "filename": "App/Api/v1/Controllers/TopicController.php",
    "groupTitle": "论坛",
    "name": "GetTopicsCategoriesId"
  },
  {
    "type": "get",
    "url": "/topics/:id",
    "title": "话题详情",
    "description": "<p>话题详情</p>",
    "group": "Topic",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n    \"data\": {\n        \"id\": 1,\n        \"category_id\": 2,\n        \"title\": \"Laravel 5.3 中文文档翻译完成\",\n        \"content\": \"<p style=\\\"box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; line-height: 30px; color: rgb(82, 82, 82); font-family: NotoSansHans-Regular, AvenirNext-Regular, arial, \\\" hiragino=\\\"\\\" sans=\\\"\\\" microsoft=\\\"\\\" wenquanyi=\\\"\\\" micro=\\\"\\\" white-space:=\\\"\\\" background-color:=\\\"\\\"><img src=\\\"https://dn-phphub.qbox.me/uploads/images/201608/24/1/IEQ4Xir8sH.jpg\\\" alt=\\\"\\\" data-type=\\\"image\\\" style=\\\"box-sizing: border-box; border: 1px solid rgb(221, 221, 221); vertical-align: middle; max-width: 100%; box-shadow: rgb(204, 204, 204) 0px 0px 30px; margin-bottom: 30px; margin-top: 10px;\\\"/></p><p style=\\\"box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; line-height: 30px; color: rgb(82, 82, 82); font-family: NotoSansHans-Regular, AvenirNext-Regular, arial, \\\" hiragino=\\\"\\\" sans=\\\"\\\" microsoft=\\\"\\\" wenquanyi=\\\"\\\" micro=\\\"\\\" white-space:=\\\"\\\" background-color:=\\\"\\\">文档地址在此：<a href=\\\"https://laravel-china.org/docs/5.3\\\" style=\\\"box-sizing: border-box; background: transparent; color: rgb(5, 161, 162); text-decoration: none;\\\">https://laravel-china.org/docs/5.3</a></p><p style=\\\"box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; line-height: 30px; color: rgb(82, 82, 82); font-family: NotoSansHans-Regular, AvenirNext-Regular, arial, \\\" hiragino=\\\"\\\" sans=\\\"\\\" microsoft=\\\"\\\" wenquanyi=\\\"\\\" micro=\\\"\\\" white-space:=\\\"\\\" background-color:=\\\"\\\">翻译的召集帖：<a href=\\\"https://laravel-china.org/topics/2752\\\" style=\\\"box-sizing: border-box; background: transparent; color: rgb(5, 161, 162); text-decoration: none;\\\">https://laravel-china.org/topics/2752</a></p><p style=\\\"box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; line-height: 30px; color: rgb(82, 82, 82); font-family: NotoSansHans-Regular, AvenirNext-Regular, arial, \\\" hiragino=\\\"\\\" sans=\\\"\\\" microsoft=\\\"\\\" wenquanyi=\\\"\\\" micro=\\\"\\\" white-space:=\\\"\\\" background-color:=\\\"\\\">参与人员列表：<a href=\\\"https://laravel-china.org/roles/7\\\" style=\\\"box-sizing: border-box; background: transparent; color: rgb(5, 161, 162); text-decoration: none;\\\">Laravel 5.3 译者</a></p><p style=\\\"box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; line-height: 30px; color: rgb(82, 82, 82); font-family: NotoSansHans-Regular, AvenirNext-Regular, arial, \\\" hiragino=\\\"\\\" sans=\\\"\\\" microsoft=\\\"\\\" wenquanyi=\\\"\\\" micro=\\\"\\\" white-space:=\\\"\\\" background-color:=\\\"\\\">项目托管在 Github 上，欢迎提交反馈：<a href=\\\"https://github.com/laravel-china/laravel-docs\\\" style=\\\"box-sizing: border-box; background: transparent; color: rgb(5, 161, 162); text-decoration: none;\\\">https://github.com/laravel-china/laravel-docs</a></p><blockquote style=\\\"box-sizing: border-box; padding: 6px 8px; border-left: 4px solid rgb(221, 221, 221); line-height: 30px; color: rgb(119, 119, 119); background-color: rgb(247, 247, 247); font-family: NotoSansHans-Regular, AvenirNext-Regular, arial, \\\" hiragino=\\\"\\\" sans=\\\"\\\" microsoft=\\\"\\\" wenquanyi=\\\"\\\" micro=\\\"\\\" white-space:=\\\"\\\" margin:=\\\"\\\" 20px=\\\"\\\" 0px=\\\"\\\"><p style=\\\"box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; line-height: 30px;\\\">我代表 Laravel 中文文档的受益者对 可爱的&nbsp;<a href=\\\"https://laravel-china.org/roles/7\\\" style=\\\"box-sizing: border-box; background: transparent; color: rgb(5, 161, 162); text-decoration: none;\\\">Laravel 5.3 译者</a>&nbsp;表示感谢&nbsp;<img title=\\\":beer:\\\" alt=\\\":beer:\\\" class=\\\"emoji\\\" src=\\\"https://dn-phphub.qbox.me/assets/images/emoji/beer.png\\\" align=\\\"absmiddle\\\" style=\\\"box-sizing: border-box; border: 0px; vertical-align: middle; width: 1.6em; display: inline-block; margin-bottom: 0px; margin-top: -5px; margin-left: 5px; max-width: 100%;\\\"/>&nbsp;<img title=\\\":metal:\\\" alt=\\\":metal:\\\" class=\\\"emoji\\\" src=\\\"https://dn-phphub.qbox.me/assets/images/emoji/metal.png\\\" align=\\\"absmiddle\\\" style=\\\"box-sizing: border-box; border: 0px; vertical-align: middle; width: 1.6em; display: inline-block; margin-bottom: 0px; margin-top: -5px; margin-left: 5px; max-width: 100%;\\\"/></p></blockquote><p style=\\\"box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; line-height: 30px; color: rgb(82, 82, 82); font-family: NotoSansHans-Regular, AvenirNext-Regular, arial, \\\" hiragino=\\\"\\\" sans=\\\"\\\" microsoft=\\\"\\\" wenquanyi=\\\"\\\" micro=\\\"\\\" white-space:=\\\"\\\" background-color:=\\\"\\\"><img src=\\\"https://dn-phphub.qbox.me/uploads/images/201610/19/1/F9kV4goXoU.png\\\" alt=\\\"\\\" data-type=\\\"image\\\" style=\\\"box-sizing: border-box; border: 1px solid rgb(221, 221, 221); vertical-align: middle; max-width: 100%; box-shadow: rgb(204, 204, 204) 0px 0px 30px; margin-bottom: 30px; margin-top: 10px;\\\"/></p><p><br/></p>\",\n        \"reply_count\": 4,\n        \"view_count\": 116,\n        \"vote_count\": 29,\n        \"created_at\": \"2016-10-31 03:01:39\",\n        \"user\": {\n            \"data\": {\n                \"id\": 3,\n                \"username\": \"来我家\",\n                \"name\": \"新英雄\",\n                \"mobile\": \"13111111112\",\n                \"email\": \"ghsjjshhd\",\n                \"avatar\": {\n                    \"_default\": \"http://stone.dev/uploads/avatars/20161117100823_30x30.png\",\n                    \"small\": \"http://stone.dev/uploads/avatars/20161117100823_30x30_30x30.png\",\n                    \"medium\": \"http://stone.dev/uploads/avatars/20161117100823_30x30_65x65.png\",\n                    \"large\": \"http://stone.dev/uploads/avatars/20161117100823_30x30_180x180.png\"\n                },\n                \"created_at\": \"2016-11-02 11:01:58\"\n            }\n        },\n        \"replies\": {\n            \"data\": [\n                {\n                    \"id\": 1,\n                    \"topic_id\": 1,\n                    \"user_id\": 3,\n                    \"content\": \"<p>您好，这是一条评论。<br>\\r\\n要删除评论，请先登录，然后再查看这篇文章的评论。登录后您可以看到编辑或者删除评论的选项。</p>\",\n                    \"vote_count\": 2,\n                    \"created_at\": \"2016-10-31 08:11:43\",\n                    \"replyTo_userid\": \"\",\n                    \"replyTo_username\": \"\",\n                    \"user\": {\n                        \"data\": {\n                            \"id\": 3,\n                            \"username\": \"来我家\",\n                            \"name\": \"新英雄\",\n                            \"mobile\": \"13111111112\",\n                            \"email\": \"ghsjjshhd\",\n                            \"avatar\": {\n                                \"_default\": \"http://stone.dev/uploads/avatars/20161117100823_30x30.png\",\n                                \"small\": \"http://stone.dev/uploads/avatars/20161117100823_30x30_30x30.png\",\n                                \"medium\": \"http://stone.dev/uploads/avatars/20161117100823_30x30_65x65.png\",\n                                \"large\": \"http://stone.dev/uploads/avatars/20161117100823_30x30_180x180.png\"\n                            },\n                            \"created_at\": \"2016-11-02 11:01:58\"\n                        }\n                    }\n                },\n                {\n                    \"id\": 2,\n                    \"topic_id\": 1,\n                    \"user_id\": 2,\n                    \"content\": \"<p>我是回复给admin的回复内容</p>\",\n                    \"vote_count\": 0,\n                    \"created_at\": \"2016-10-31 09:31:05\",\n                    \"replyTo_userid\": 3,\n                    \"replyTo_username\": \"来我家\",\n                    \"user\": {\n                        \"data\": {\n                            \"id\": 2,\n                            \"username\": \"user\",\n                            \"name\": \"name\",\n                            \"mobile\": \"13113113111\",\n                            \"email\": \"user@user.com\",\n                            \"avatar\": {\n                                \"_default\": \"\",\n                                \"small\": \"\",\n                                \"medium\": \"\",\n                                \"large\": \"\"\n                            },\n                            \"created_at\": \"2016-11-02 07:57:24\"\n                        }\n                    }\n                },\n                {\n                    \"id\": 7,\n                    \"topic_id\": 1,\n                    \"user_id\": 2,\n                    \"content\": \"我又来回复第一篇文章了\",\n                    \"vote_count\": 0,\n                    \"created_at\": \"2016-11-07 04:02:13\",\n                    \"replyTo_userid\": \"\",\n                    \"replyTo_username\": \"\",\n                    \"user\": {\n                        \"data\": {\n                            \"id\": 2,\n                            \"username\": \"user\",\n                            \"name\": \"name\",\n                            \"mobile\": \"13113113111\",\n                            \"email\": \"user@user.com\",\n                            \"avatar\": {\n                                \"_default\": \"\",\n                                \"small\": \"\",\n                                \"medium\": \"\",\n                                \"large\": \"\"\n                            },\n                            \"created_at\": \"2016-11-02 07:57:24\"\n                        }\n                    }\n                },\n                {\n                    \"id\": 13,\n                    \"topic_id\": 1,\n                    \"user_id\": 2,\n                    \"content\": \"我又来回复第一篇文章了\",\n                    \"vote_count\": 0,\n                    \"created_at\": \"2016-11-11 02:14:47\",\n                    \"replyTo_userid\": \"\",\n                    \"replyTo_username\": \"\",\n                    \"user\": {\n                        \"data\": {\n                            \"id\": 2,\n                            \"username\": \"user\",\n                            \"name\": \"name\",\n                            \"mobile\": \"13113113111\",\n                            \"email\": \"user@user.com\",\n                            \"avatar\": {\n                                \"_default\": \"\",\n                                \"small\": \"\",\n                                \"medium\": \"\",\n                                \"large\": \"\"\n                            },\n                            \"created_at\": \"2016-11-02 07:57:24\"\n                        }\n                    }\n                },\n                {\n                    \"id\": 14,\n                    \"topic_id\": 1,\n                    \"user_id\": 2,\n                    \"content\": \"我又来回复第一篇文章了\",\n                    \"vote_count\": 0,\n                    \"created_at\": \"2016-11-11 02:15:46\",\n                    \"replyTo_userid\": \"\",\n                    \"replyTo_username\": \"\",\n                    \"user\": {\n                        \"data\": {\n                            \"id\": 2,\n                            \"username\": \"user\",\n                            \"name\": \"name\",\n                            \"mobile\": \"13113113111\",\n                            \"email\": \"user@user.com\",\n                            \"avatar\": {\n                                \"_default\": \"\",\n                                \"small\": \"\",\n                                \"medium\": \"\",\n                                \"large\": \"\"\n                            },\n                            \"created_at\": \"2016-11-02 07:57:24\"\n                        }\n                    }\n                },\n                {\n                    \"id\": 15,\n                    \"topic_id\": 1,\n                    \"user_id\": 2,\n                    \"content\": \"我又来回复第一篇文章了\",\n                    \"vote_count\": 0,\n                    \"created_at\": \"2016-11-11 02:15:55\",\n                    \"replyTo_userid\": \"\",\n                    \"replyTo_username\": \"\",\n                    \"user\": {\n                        \"data\": {\n                            \"id\": 2,\n                            \"username\": \"user\",\n                            \"name\": \"name\",\n                            \"mobile\": \"13113113111\",\n                            \"email\": \"user@user.com\",\n                            \"avatar\": {\n                                \"_default\": \"\",\n                                \"small\": \"\",\n                                \"medium\": \"\",\n                                \"large\": \"\"\n                            },\n                            \"created_at\": \"2016-11-02 07:57:24\"\n                        }\n                    }\n                }\n            ]\n        }\n    }\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/topics/1"
      }
    ],
    "filename": "App/Api/v1/Controllers/TopicController.php",
    "groupTitle": "论坛",
    "name": "GetTopicsId"
  },
  {
    "type": "get",
    "url": "/topics/:id/replies",
    "title": "话题所有回复",
    "description": "<p>话题所有回复</p>",
    "group": "Topic",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 201 Created\n{\n    \"data\": [\n        {\n            \"id\": 1,\n            \"topic_id\": 1,\n            \"user_id\": 1,\n            \"content\": \"<p>您好，这是一条评论。<br>\\r\\n要删除评论，请先登录，然后再查看这篇文章的评论。登录后您可以看到编辑或者删除评论的选项。</p>\",\n            \"created_at\": \"2016-10-31 16:11:43\",\n            \"updated_at\": \"2016-10-31 16:47:44\",\n            \"replyTo_userid\": \"\",\n            \"replyTo_username\": \"\",\n            \"user\": {\n                \"data\": {\n                    \"id\": 1,\n                    \"username\": \"admin\",\n                    \"mobile\": \"13111111111\",\n                    \"email\": \"admin@admin.com\",\n                    \"avatar\": \"http://stone.dev/uploads/avatars/20161107085531.png\",\n                    \"created_at\": \"2016-11-02 15:57:24\"\n                }\n            }\n        },\n        {\n            \"id\": 2,\n            \"topic_id\": 1,\n            \"user_id\": 2,\n            \"content\": \"<p>我是回复给admin的回复内容</p>\",\n            \"created_at\": \"2016-10-31 17:31:05\",\n            \"updated_at\": \"2016-11-01 10:39:04\",\n            \"replyTo_userid\": 1,\n            \"replyTo_username\": \"admin\",\n            \"user\": {\n                \"data\": {\n                    \"id\": 2,\n                    \"username\": \"user\",\n                    \"mobile\": \"13113113111\",\n                    \"email\": \"user@user.com\",\n                    \"avatar\": \"http://stone.dev/uploads/avatars/default/medium.png\",\n                    \"created_at\": \"2016-11-02 15:57:24\"\n                }\n            }\n        },\n        {\n            \"id\": 7,\n            \"topic_id\": 1,\n            \"user_id\": 2,\n            \"content\": \"我又来回复第一篇文章了\",\n            \"created_at\": \"2016-11-07 12:02:13\",\n            \"updated_at\": \"2016-11-07 12:02:13\",\n            \"replyTo_userid\": \"\",\n            \"replyTo_username\": \"\",\n            \"user\": {\n                \"data\": {\n                    \"id\": 2,\n                    \"username\": \"user\",\n                    \"mobile\": \"13113113111\",\n                    \"email\": \"user@user.com\",\n                    \"avatar\": \"http://stone.dev/uploads/avatars/default/medium.png\",\n                    \"created_at\": \"2016-11-02 15:57:24\"\n                }\n            }\n        }\n    ]\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/topics/1/replies"
      }
    ],
    "filename": "App/Api/v1/Controllers/TopicController.php",
    "groupTitle": "论坛",
    "name": "GetTopicsIdReplies"
  },
  {
    "type": "get",
    "url": "/topics/search",
    "title": "话题搜索",
    "description": "<p>话题搜索</p>",
    "group": "Topic",
    "permission": [
      {
        "name": "无"
      }
    ],
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "q",
            "description": "<p>搜索关键字</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "categories",
            "description": "<p>话题分类</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/topics/search"
      }
    ],
    "filename": "App/Api/v1/Controllers/TopicController.php",
    "groupTitle": "论坛",
    "name": "GetTopicsSearch"
  },
  {
    "type": "post",
    "url": "/topics",
    "title": "发布话题",
    "description": "<p>发布话题</p>",
    "group": "Topic",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>标题</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "content",
            "description": "<p>内容</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "allowedValues": [
              "1",
              "2",
              "3",
              "4",
              "5",
              "6"
            ],
            "optional": false,
            "field": "category_id",
            "description": ""
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 201 Created",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/topics"
      }
    ],
    "filename": "App/Api/v1/Controllers/TopicController.php",
    "groupTitle": "论坛",
    "name": "PostTopics"
  },
  {
    "type": "post",
    "url": "/topics/:id/favorites",
    "title": "话题收藏",
    "description": "<p>话题收藏</p>",
    "group": "Topic",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 201 Created",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/topics/1/favorites"
      }
    ],
    "filename": "App/Api/v1/Controllers/TopicController.php",
    "groupTitle": "论坛",
    "name": "PostTopicsIdFavorites"
  },
  {
    "type": "post",
    "url": "/topics/:id/replies",
    "title": "话题回复",
    "description": "<p>话题回复 :id</p>",
    "group": "Topic",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "parent_id",
            "description": "<p>回复给某条回复 此ID为回复的ID 不回复用户则为0</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "content",
            "description": "<p>回复内容</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 201 Created",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/topics/1/replies"
      }
    ],
    "filename": "App/Api/v1/Controllers/TopicController.php",
    "groupTitle": "论坛",
    "name": "PostTopicsIdReplies"
  },
  {
    "type": "post",
    "url": "/topics/:id/vote",
    "title": "话题点赞",
    "description": "<p>话题点赞 :id</p>",
    "group": "Topic",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 204 No Content",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/topics/1/vote"
      }
    ],
    "filename": "App/Api/v1/Controllers/TopicController.php",
    "groupTitle": "论坛",
    "name": "PostTopicsIdVote"
  },
  {
    "type": "post",
    "url": "/topics/replies/:id/vote",
    "title": "回复点赞",
    "description": "<p>回复点赞 :id</p>",
    "group": "Topic",
    "permission": [
      {
        "name": "认证"
      }
    ],
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer {access_token}</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 204 No Content",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/topics/replies/1/vote"
      }
    ],
    "filename": "App/Api/v1/Controllers/TopicController.php",
    "groupTitle": "论坛",
    "name": "PostTopicsRepliesIdVote"
  },
  {
    "type": "post",
    "url": "/upload/avatar",
    "title": "上传头像",
    "description": "<p>上传头像</p>",
    "group": "Upload",
    "permission": [
      {
        "name": "无"
      }
    ],
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "File",
            "optional": false,
            "field": "images[]",
            "description": "<p>上传的头像</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n  \"data\": {\n    \"avatar\": {\n      \"_default\": \"http://stone.dev/uploads/avatars/20161115071249.png\",\n      \"large\": \"http://stone.dev/uploads/avatars/20161115071249_180x180.png\",\n      \"medium\": \"http://stone.dev/uploads/avatars/20161115071249_65x65.png\",\n      \"small\": \"http://stone.dev/uploads/avatars/20161115071249_30x30.png\"\n    }\n  }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "App/Api/v1/Controllers/UploadController.php",
    "groupTitle": "上传",
    "name": "PostUploadAvatar"
  },
  {
    "type": "post",
    "url": "/upload/company",
    "title": "认证或需求",
    "description": "<p>认证或需求</p>",
    "group": "Upload",
    "permission": [
      {
        "name": "无"
      }
    ],
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "File",
            "optional": false,
            "field": "images[]",
            "description": "<p>上传的图片</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n  \"data\": {\n    \"url\": [\n      \"http://stone.dev/storage/companies/2016/11/031150tN1t.png\"\n    ]\n  }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "App/Api/v1/Controllers/UploadController.php",
    "groupTitle": "上传",
    "name": "PostUploadCompany"
  },
  {
    "type": "post",
    "url": "/upload/product",
    "title": "上传产品",
    "description": "<p>上传产品</p>",
    "group": "Upload",
    "permission": [
      {
        "name": "无"
      }
    ],
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "File",
            "optional": false,
            "field": "images[]",
            "description": "<p>上传的图片</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n  \"data\": {\n    \"url\": [\n        \"http://stone.dev/uploads/products/2016/11/071549GTEr.png\"\n    ]\n  }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "App/Api/v1/Controllers/UploadController.php",
    "groupTitle": "上传",
    "name": "PostUploadProduct"
  }
] });
