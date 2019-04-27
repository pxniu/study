#php框架
# 使用方法
1.Sql操作升级
采用方法注解实现 如：

@Select(sql = "select * from user where username = {username}")

@Update(sql = "update user set price = price + {price} where id = {id}")

@Insert(sql = "insert into user (username, password, age, height, price, addtime) values ({username}, {password}, {age}, {height}, {price}, now())")

@Delete(sql = "delete from user where id = {id}")

@SelectOne(sql = "select * from user where id = {id}")

@Update(sql = "update user set username = {username} where id = {id}")

参数通过{}注入

2.事物升级
采用方法注解实现 如:

    /**
     * @Transactional
     * 事物service
     */
    function updateUser()
    {
    
    }
3.数据操作注入升级 如:

    class Index {
        /**
         * @Autowired(class = "\hyweb\service\Home\impl\UserServiceImpl")
         */
        private $service;
    
        /**
         * @Autowired(class = "\hyweb\service\Home\impl\PayServiceImpl")
         */
        private $payService;
    
        public function index() {
            echo Config::get("db.master", "host");
            p($this->payService->getAll());
        }
    }
4.数据判断注入 如:

    /**
     * @Select(sql = "select * from role <if test='name != null'>where name like %{name}%</if> order by addtime desc limit {start}, {limit}")
     */
    public function getAllByExcemples() {

    }
5.数据循环注入 如:
    
    /**
     * @Insert(sql = "
        insert into roles (roleId, permissionId) values
          <foreach collection='list' item='r' separator=",">
            ({roleId}, #id#})
          </foreach>
     ")
     */
    public function adds() {

    }