# Algo-php 

## Class question 
+ lưu từng câu hỏi vào file questionStore.txt

### ví dụ

```php 
<?php
namespace algo;
class Question {
   public $question;
   public $answer;
   public function __construct($question,$answer){
      $this->question = $question;
      $this->answer = $answer;
   }
}
?>
// class question khởi tạo câu một đối tượng theo cấu trúc câu hỏi và câu trả lời 
```
```
// kết quả 
 trả ra một cấu trúc câu hỏi và câu trả lời lưu vào trong question list  
``` 
### 2 class Question List Lưu toàn bộ câu hỏi 
```
class này có tác dụng lưu toàn bộ câu hỏi đã qua xử l từ file questions.md bên trên 

```
### ví dụ
```php
<?php
namespace algo;
class QuestionList{
  public $questionlist = [];
  public function __construct($questionlist =[]){
     $this->questionlist = $questionlist;
  }
  // lấy tên file và xử lý file
  public function parse($path){
    $file = file_get_contents($path);
    $questionrm = $file;
      $arrayQuestions =explode("######",$questionrm);
      array_shift($arrayQuestions);
      foreach($arrayQuestions as $key=>$val){ 
        [$question,$answer] = explode("####",$val);
        $this->questionlist[] = new Question($question,$answer);
      };
  }
  // hiển thị toàn bộ câu hỏi đã lấy từ file questions.md
  public function all(){
    $qlist =$this->questionlist;
    if($qlist!=Null){
      dump($qlist);
    }else{
      return 'nothing to show';
    }

  }
}

```
### từ file index ta sẽ execute class questionlist như sau 

```php
 <?php
use algo\QuestionList;
$questionlist = new QuestionList();
$questionlist->parse("questions.md");
$questionlist->all();
?>
```
## kết quả ta thu được là 
![](./photo/result.png)
# DTO
=> thực hành theo yêu cầu trong link: https://drive.google.com/file/d/1fpGVj1lmQSYyKCnZyDE1DurYfbEjcuUD/view?usp=sharing
### mục đích của bài
```angular2html
tìm hiểu về class, abstract class, trait, interfaces trong php và đặc biệt 
là hiểu được sự tương quan lẫn nhau giữa các class với trait và giữa class 
với interfaces và giữa abstract class với các interfaces, kết thúc bài thực hành này sẽ rút
ra được một kết luận về sự tương tác lẫn nhau và đặc điểm của từng thành phần class
trong OOP.

```
# Ví dụ
1. trong thư mục dto sẽ có file composer.json để dùng psr-4 để khai báo files sẽ được tự động load 
```php
 {
    "name": "oop_in_php/dto",
    "description": "description",
    "minimum-stability": "stable",
    "license": "d",
    "authors": [
      {
        "name": "dong",
        "email": "lovandong342@gmail.com"
      }
    ],
    "autoload": {
      "psr-4": {
        "src\\": "src/"
      }
    },
    "require": {
        "nesbot/carbon": "^2.62"
    },
    "require-dev": {
        "symfony/var-dumper": "^6.1"
    }
}
// symfony/var-dumper dùng package này để dump dữ liệu ra để xem hoặc fixed lỗi thay vì
dùng echo, print_r hay var_dump . dump sẽ cho một trải nghiệm view tốt hơn 
ngoài ra ta có thể dùng dd cũng tương tự dump
// sau khi đã khai báo với psr-4 xong thì ta chạy lệnh sau 
composer dump-autoload để execute nó
```
2. cấu trúc thư mục
```angular2html
//src
   /interfaces
   Book.php
   Datas.php
   HashAttibute.php
   User.php
//vendor
```
==> kết quả thu được sau bài này 
```angular2html
+ tiến hành khởi tạo 2 mảng Book, Và User
$bookArr =[
['name'=>'Book A','author'=>'Nguyen van A'],
['name'=>'Book B','author'=>'Nguyen van B']
];
$array=[
['name' => 'Nguyễn Gia Hào', 'email' => 'giahao9899@gmail.com'],
['name' => 'VNP Group', 'email' => 'vnp@gmail.com'],
];

1.test User Class 

$user = new User();
$testU = $user::collection($array);
dump($testU->test());
dump($testU->all());
echo $user->test();
$user->name ="lò văn đồng";
$user->email = "lovandong342@gmail.com";
dump($user->name);
dump ($user->email);


2. Test Book Class


$book = new Book();
echo $book->test();
$testb = $book::collection($bookArr);
dump($testb->all());
dump($testb->last());// kết quả : array số 2
dump($testb->first());// kết quả :array số 1;
dump($testb->count($bookArr));
?>
```
### kết quả đạt được 
```angular2html
1. Kết quả sau khi chạy User Class
^ array:2 [▼
0 => src\User {#5 ▼
#original: []
#casts: []
-attributes: array:2 [▼
"name" => "Nguyễn Gia Hào"
"email" => "giahao9899@gmail.com"
]
}
1 => src\User {#6 ▼
#original: []
#casts: []
-attributes: array:2 [▼
"name" => "VNP Group"
"email" => "vnp@gmail.com"
]
}
]
test function
^ null
^ array:2 [▼
"name" => "lò văn đồng"
"email" => "lovandong342@gmail.com"
]
^ array:2 [▼
"name" => "lò văn đồng"
"email" => "lovandong342@gmail.com"
]

2. kết quả sau khi chạy Book class

^ array:2 [▼
0 => src\Book {#15 ▼
#original: []
#casts: []
-attributes: array:2 [▼
"name" => "Book A"
"author" => "Nguyen van A"
]
}
1 => src\Book {#14 ▼
#original: []
#casts: []
-attributes: array:2 [▼
"name" => "Book B"
"author" => "Nguyen van B"
]
}
]
^ src\Book {#14 ▼
#original: []
#casts: []
-attributes: array:2 [▼
"name" => "Book B"
"author" => "Nguyen van B"
]
}
^ src\Book {#15 ▼
#original: []
#casts: []
-attributes: array:2 [▼
"name" => "Book A"
"author" => "Nguyen van A"
]
}
^ 2
```
# Lý thuyết
## OOP IN PHP 

## OOP viết tắt của Object-Oriented Programming
I.Ưu điểm của lập trình hướng đối tượng
Vì lập trình hướng đối tượng ra đời sau nên nó khắc phục được tất cả các điểm yếu của các phương pháp lập trình trước đó. Cụ thể nó các ưu điểm sau:

* Dễ dàng quản lý code khi có sự thay đổi chương trình.
-Dễ mở rộng dự án.
-Tiết kiệm được tài nguyên đáng kể cho hệ thống.
-Có tính bảo mật cao.
-Có tính tái sử dụng cao.
**Lập trình hướng đối tượng có 4 tính chất chính:
+ Tính trìu tượng (abstraction).
+ Tính kế thừa (inheritance).
+ Tính đóng gói (encapsulation).
+ Tính đa hình (polymorphism)
***Một số khái niệm cơ bản trong lập trình hướng đối tượng
## Đối tượng (object):

Trong lập trình hướng đối tượng, đối tượng được hiểu như là 1 thực thể: người, vật hoặc 1 bảng dữ liệu, . . .
Một đối tượng bao gồm 2 thông tin: thuộc tính và phương thức:
Thuộc tính chính là những thông tin, đặc điểm của đối tượng. Ví dụ: một người sẽ có họ tên, ngày sinh, màu da, kiểu tóc, . . .
Phương thức là những thao tác, hành động mà đối tượng đó có thể thực hiện. Ví dụ: một người sẽ có thể thực hiện hành động nói, đi, ăn, uống, . . .

## Lớp (class):

Các đối tượng có các đặc tính tương tự nhau được gom lại thành 1 lớp đối tượng.
Bên trong lớp cũng có 2 thành phần chính đó là thuộc tính và phương thức.
Ngoài ra, lớp còn được dùng để định nghĩa ra kiểu dữ liệu mới.
```
    class Name
    {
    //code
    }
```
Trong đó: Name là tên của class. Nó có các rằng buộc về tên giống như đặt tên hàm trong hướng thủ tục.

+Note: khác nhau giữa đối tượng và lớp:
-Lớp là một khuôn mẫu còn đối tượng là một thể hiện cụ thể dựa trên khuôn mẫu đó.

    Để dễ hiểu hơn mình sẽ lấy một ví dụ thực tế:

    Để dễ hiểu hơn mình sẽ lấy một ví dụ thực tế:

    Các thông tin, đặc điểm như 4 chân, 2 mắt, có đuôi, có chiều cao, có cân nặng, màu lông . . .
    Các hành động như: kêu meo meo, đi, ăn, ngủ, . . .
    Như vậy mọi động vật thuộc loài mèo sẽ có những đặc điểm như trên.

    Đối tượng chính là một con mèo cụ thể nào đó.

## II.Các tính chất của lập trình hướng đối tượng
1.Tính trìu tượng (abstraction)
    Trìu tượng hóa là quá trình đơn giản hóa một đối tượng mà trong đó chỉ bao gồm những đặc điểm quan tâm và bỏ qua những đặc điểm chi tiết nhỏ. Quá trình

    trừu tượng hóa dữ liệu giúp ta xác định được những thuộc tính, hành động nào của đối tượng cần thiết sử dụng cho chương trình.

    Để hiểu rõ về tính trìu tượng ta tìm hiểu về Abstract class và Interface.
1.1. Abstract class

    Lớp Abstract sẽ định nghĩa các phương thức (hàm) mà từ đó các lớp con sẽ kế thừa nó và Overwrite lại (tính đa hình).

    Đối với lớp này thì nó sẽ có các điểm khác sau:

    Các phương thức ( hàm ) khi được khai báo là abstract thì chỉ được định nghĩa chứ không được phép viết code xử lý trong phương thức.
    Trong abstract class nếu không phải là phương thức abstract thì vẫn khai báo và viết code được như bình thường.
    Phương thức abstract chỉ có thể khai báo trong abstract class.
    Các thuộc tính trong abstract class thì không được khai báo là abstract.
    Không thể khởi tạo một abstract class.
    Vì không thể khởi tạo được abstract class nên các phương thức được khai báo là abstract chỉ được khai báo ở mức độ protected và public.
    Các lớp kế thừa một abstract class phải định nghĩa lại tất cả các phương thức trong abstract class đó ( nếu không sẽ bị lỗi).
    Và để khai báo một abstract class ta dùng cú pháp sau:
```
    abstract class ClassName
    {

    }
```
Trong đó: ClassName là tên của class chúng ta cần khai báo.

    Cú pháp khai báo một phương thức abstract:
    abstract visibility function methodName();

    Trong đó: visibility là một trong 2 từ khóa public, protected hoặc có thể bỏ trống (bỏ trống thì là public), methodName là tên của phương thức chúng ta cần khai báo.

Ví dụ 1: khai báo một phương thức abstract trong abstract class
```
    abstract class ConNguoi
    {
        //khai báo một abstract method đúng
        abstract public function getName();

        //Sai vì abstract class không thể viết code xử lý được
        abstract public function getHeight()
        {
            //
        }
    }
```

## Ví dụ 2: Phải định nghĩa lại các phương thức abstract của abstract class đó khi kế thừa.
```
    abstract class ConNguoi
    {
        protected $name;
        abstract protected function getName();
    }

    //class này sai vì chưa định nghĩa lại phương thức abstracs getName
    class NguoiLon extends ConNguoi
    {
        //
    }

    //class này đúng vì đã định nghĩa lại đầy đủ các phương thức abstract
    class TreTrau extends ConNguoi
    {
        public function getName()
        {
            return $this->name;
        }
    }
```
## 1.2. Interface

* Interface trong hướng đối tượng là một khuôn mẫu, giúp cho chúng ta tạo ra bộ khung cho một hoặc nhiều đối tượng và nhìn vào interface thì chúng ta hoàn toàn có thể xác định được các phương thức và các thuộc tính cố định (hay còn gọi là hằng) sẽ có trong đối tượng implement nó.

### Để khai báo interface trong PHP chúng ta dùng cú pháp:
```
    interface InterfaceName
    {

    }
```
Trong đó: InterfaceName là tên của interface các bạn muốn đặt.

++Tính chất của interface

    Interface không phải là một đối tượng.

    Trong interface chúng ta chỉ được khai báo phương thức chứ không được định nghĩa chúng.

    Trong interface chúng ta có thể khai báo được hằng nhưng không thể khai báo biến.
    
    Một interface không thể khởi tạo được (vì nó không phải là một đối tượng).

    Các lớp implement interface thì phải khai báo và định nghĩa lại các phương thức có trong interface đó.

    Một class có thể implements nhiều interface.

    Các interface có thể kế thừa lẫn nhau.

1.3. So sánh giữa interface và abstract class

Những điểm giống nhau giữa interface và abstract class:

    Đều không thể khởi tạo đối tượng.

    Đều có thể chứa phương thức abstract.

+Những điểm khác nhau:

## ***Interface

    + Chỉ có thể kế thừa nhiều interface khác.

    + Chỉ chứa các khai báo và không có phần nội dung

    + Không có constructor và cũng không có destructor.

    + Phạm vi truy cập mặc định là public

    + Dùng để định nghĩa 1 khuôn mẫu hoặc quy tắc chung.

    + Cần thời gian để tìm phương thức thực tế tương ứng với lớp dẫn đến thời gian chậm hơn 1 chút.

    + Khi ta thêm mới 1 khai báo. Ta phải tìm hết tất cả những lớp có thực thi interface này để định nghĩa nội dung cho phương thức mới.

## ***Abstract class

    + Có thể kế thừa từ 1 lớp và nhiều interface.

    + Có thể chứa các thuộc tính thường và các phương thức bình thường bên trong.

    + Có constructor và destructor.

    + Có thể xác định modifier.

    + Dùng để định nghĩa cốt lõi của lớp, thành phần chung của lớp và sử dụng cho nhiều đối tượng cùng kiểu.

    + Nhanh hơn so với interface.

    + Đối với abstract class, khi đĩnh nghĩa 1 phương thức mới ta hoàn toàn có thể định nghĩa nội dung phương thức là rỗng hoặc những thực thi mặc định nào đó. Vì thế toàn bộ hệ thống vẫn chạy bình thường.

## 2. Tính kế thừa (inheritance)

Tính kế thừa trong lập trình hướng đối tượng cho phép một lớp (class) có thể kế thừa các thuộc tính và phương thức từ các lớp khác đã được định nghĩa. Lớp được kế thừa còn được gọi là lớp cha và lớp kế thừa được gọi là lớp con.

Điều này cho phép các đối tượng có thể tái sử dụng hay mở rộng các đặc tính sẵn có mà không phải tiến hành định nghĩa lại.

Trong PHP để khai báo kế thừa từ một lớp cha chúng ta sử dụng từ khóa extends theo cú pháp:
```
    class childClass extends parentClass
    {
        //code
    }
```
+Trong đó: childClass là class mà các bạn đang muốn khởi tạo, parentClass là class cha mà childClass đang muốn kế thừa nó.

## 3. Tính đóng gói (encapsulation)

3.1.Tính đóng gói là tính chất không cho phép người dùng hay đối tượng khác thay đổi dữ liệu thành viên của đối tượng nội tại. Chỉ có các hàm thành viên của đối tượng đó mới có quyền thay đổi trạng thái nội tại của nó mà thôi. Các đối tượng khác muốn thay đổi thuộc tính thành viên của đối tượng nội tại, thì chúng cần truyền thông điệp cho đối tượng, và việc quyết định thay đổi hay không vẫn do đối tượng nội tại quyết định. Trong PHP việc đóng gói được thực hiện nhờ sử dụng các từ khoá public, private và protected:


## 1. Lập trình hướng đối tượng là gì?
OOP viết tắt của Object-Oriented Programming – Lập trình hướng đối tượng ra đời giải quyết các vấn đề mà lập trình truyền thống gặp phải. Lập trình hướng đối tượng không chỉ đơn giản là các cú pháp, câu lệnh mới mà còn là một cách tư duy mới khi giải quyết một vấn đề. Thực tế khi làm một việc gì đó, chúng ta sẽ quan tâm đến hai điều: vật bị tác động và hành động. Với lập trình cũng vậy, nếu chúng ta tập trung vào hành động thì đó là lập trình hướng thủ tục còn nếu tập trung vào các vật thể thì đó là lập trình hướng đối tượng. Với cả hai cách giải quyết vấn đề, đều cho chúng ta một kết quả như nhau, chỉ có một điều khác nhau là cách chúng ta tập trung vào cái gì?

Trong lập trình hướng đối tượng OOP, có hai thuật ngữ rất quan trọng là lớp (class) và đối tượng (object). Class là định nghĩa chung cho một vật, để dễ tưởng tượng bạn có thể nghĩ đến class là một bản thiết kế trong khi đó đối tượng là một thực hiện cụ thể của bản thiết kế. Ví dụ, object là một ngôi nhà cụ thể thì class là bản thiết kế ngôi nhà đó. Lập trình hướng đối tượng là cách bạn thiết kế các class và sau đó thực hiện chúng thành các đối tượng trong chương trình khi cần.

## Lập trình hướng đối tượng có 4 tính chất chính:

+Tính trìu tượng (abstraction).
+Tính kế thừa (inheritance).
+Tính đóng gói (encapsulation).
+Tính đa hình (polymorphism).
## 2. Ưu điểm của lập trình hướng đối tượng
Vì lập trình hướng đối tượng ra đời sau nên nó khắc phục được tất cả các điểm yếu của các phương pháp lập trình trước đó. Cụ thể nó các ưu điểm sau:

### Dễ dàng quản lý code khi có sự thay đổi chương trình.
Dễ mở rộng dự án.
Tiết kiệm được tài nguyên đáng kể cho hệ thống.
Có tính bảo mật cao.
Có tính tái sử dụng cao.
3. Một số khái niệm cơ bản trong lập trình hướng đối tượng
3.1. Đối tượng (object):

Trong lập trình hướng đối tượng, đối tượng được hiểu như là 1 thực thể: người, vật hoặc 1 bảng dữ liệu, . . .

### Một đối tượng bao gồm 2 thông tin: thuộc tính và phương thức:

Thuộc tính chính là những thông tin, đặc điểm của đối tượng. Ví dụ: một người sẽ có họ tên, ngày sinh, màu da, kiểu tóc, . . .
Phương thức là những thao tác, hành động mà đối tượng đó có thể thực hiện. Ví dụ: một người sẽ có thể thực hiện hành động nói, đi, ăn, uống, . . .
3.2 Lớp (class):

Các đối tượng có các đặc tính tương tự nhau được gom lại thành 1 lớp đối tượng.
Bên trong lớp cũng có 2 thành phần chính đó là thuộc tính và phương thức.
Ngoài ra, lớp còn được dùng để định nghĩa ra kiểu dữ liệu mới.
Và để khai báo nó trong PHP thì chúng ta sử dụng cú pháp sau:
```
class Name
{
//code
}
```
### Trong đó: Name là tên của class. Nó có các rằng buộc về tên giống như đặt tên hàm trong hướng thủ tục.

3.3 Sự khác nhau giữa đối tượng và lớp:

Lớp là một khuôn mẫu còn đối tượng là một thể hiện cụ thể dựa trên khuôn mẫu đó.

Để dễ hiểu hơn mình sẽ lấy một ví dụ thực tế:

Để dễ hiểu hơn mình sẽ lấy một ví dụ thực tế:

Các thông tin, đặc điểm như 4 chân, 2 mắt, có đuôi, có chiều cao, có cân nặng, màu lông . . .
Các hành động như: kêu meo meo, đi, ăn, ngủ, . . .
Như vậy mọi động vật thuộc loài mèo sẽ có những đặc điểm như trên.

Đối tượng chính là một con mèo cụ thể nào đó.

4. Các tính chất của lập trình hướng đối tượng
4.1. Tính trìu tượng (abstraction)

Trìu tượng hóa là quá trình đơn giản hóa một đối tượng mà trong đó chỉ bao gồm những đặc điểm quan tâm và bỏ qua những đặc điểm chi tiết nhỏ. Quá trình trừu tượng hóa dữ liệu giúp ta xác định được những thuộc tính, hành động nào của đối tượng cần thiết sử dụng cho chương trình.

Để hiểu rõ về tính trìu tượng chúng ta sẽ tìm hiểu về Abstract class và Interface.

4.1.1. Abstract class

Lớp Abstract sẽ định nghĩa các phương thức (hàm) mà từ đó các lớp con sẽ kế thừa nó và Overwrite lại (tính đa hình).

Đối với lớp này thì nó sẽ có các điểm khác sau:

Các phương thức ( hàm ) khi được khai báo là abstract thì chỉ được định nghĩa chứ không được phép viết code xử lý trong phương thức.
Trong abstract class nếu không phải là phương thức abstract thì vẫn khai báo và viết code được như bình thường.
Phương thức abstract chỉ có thể khai báo trong abstract class.
Các thuộc tính trong abstract class thì không được khai báo là abstract.
Không thể khởi tạo một abstract class.
Vì không thể khởi tạo được abstract class nên các phương thức được khai báo là abstract chỉ được khai báo ở mức độ protected và public.
Các lớp kế thừa một abstract class phải định nghĩa lại tất cả các phương thức trong abstract class đó ( nếu không sẽ bị lỗi).
Và để khai báo một abstract class ta dùng cú pháp sau:
```
abstract class ClassName
{

}
```
Trong đó: ClassName là tên của class chúng ta cần khai báo.

Cú pháp khai báo một phương thức abstract:

abstract visibility function methodName();

Trong đó: visibility là một trong 2 từ khóa public, protected hoặc có thể bỏ trống (bỏ trống thì là public), methodName là tên của phương thức chúng ta cần khai báo.

Ví dụ 1: khai báo một phương thức abstract trong abstract class
```
abstract class ConNguoi
{
    //khai báo một abstract method đúng
    abstract public function getName();

    //Sai vì abstract class không thể viết code xử lý được
    abstract public function getHeight()
    {
        //
    }
}
```

Ví dụ 2: Phải định nghĩa lại các phương thức abstract của abstract class đó khi kế thừa.
```
abstract class ConNguoi
{
    protected $name;
    abstract protected function getName();
}

//class này sai vì chưa định nghĩa lại phương thức abstracs getName
class NguoiLon extends ConNguoi
{
    //
}

//class này đúng vì đã định nghĩa lại đầy đủ các phương thức abstract
class TreTrau extends ConNguoi
{
    public function getName()
    {
        return $this->name;
    }
}
```
4.1.2. Interface

Interface trong hướng đối tượng là một khuôn mẫu, giúp cho chúng ta tạo ra bộ khung cho một hoặc nhiều đối tượng và nhìn vào interface thì chúng ta hoàn toàn có thể xác định được các phương thức và các thuộc tính cố định (hay còn gọi là hằng) sẽ có trong đối tượng implement nó.

Để khai báo interface trong PHP chúng ta dùng cú pháp:
```
interface InterfaceName
{

}
```
Trong đó: InterfaceName là tên của interface các bạn muốn đặt.

### Tính chất của interface

 * Interface không phải là một đối tượng.
 * Trong interface chúng ta chỉ được khai báo phương thức chứ không được định nghĩa chúng.
 * Trong interface chúng ta có thể khai báo được hằng nhưng không thể khai báo biến.
 * Một interface không thể khởi tạo được (vì nó không phải là một đối tượng).
 * Các lớp implement interface thì phải khai báo và định nghĩa lại các phương thức có trong interface đó.
 * Một class có thể implements nhiều interface.
 * Các interface có thể kế thừa lẫn nhau.
4.1.3. So sánh giữa interface và abstract class

Những điểm giống nhau giữa interface và abstract class:

Đều không thể khởi tạo đối tượng.
Đều có thể chứa phương thức abstract.
Những điểm khác nhau:

4.2. Tính kế thừa (inheritance)

Tính kế thừa trong lập trình hướng đối tượng cho phép một lớp (class) có thể kế thừa các thuộc tính và phương thức từ các lớp khác đã được định nghĩa. Lớp được kế thừa còn được gọi là lớp cha và lớp kế thừa được gọi là lớp con.

Điều này cho phép các đối tượng có thể tái sử dụng hay mở rộng các đặc tính sẵn có mà không phải tiến hành định nghĩa lại.

Trong PHP để khai báo kế thừa từ một lớp cha chúng ta sử dụng từ khóa extends theo cú pháp:
```
class childClass extends parentClass
{
    //code
}
```
Trong đó: childClass là class mà các bạn đang muốn khởi tạo, parentClass là class cha mà childClass đang muốn kế thừa nó.

4.3. Tính đóng gói (encapsulation)

Tính đóng gói là tính chất không cho phép người dùng hay đối tượng khác thay đổi dữ liệu thành viên của đối tượng nội tại. Chỉ có các hàm thành viên của đối tượng đó mới có quyền thay đổi trạng thái nội tại của nó mà thôi. Các đối tượng khác muốn thay đổi thuộc tính thành viên của đối tượng nội tại, thì chúng cần truyền thông điệp cho đối tượng, và việc quyết định thay đổi hay không vẫn do đối tượng nội tại quyết định. Trong PHP việc đóng gói được thực hiện nhờ sử dụng các từ khoá public, private và protected:

    + Private là giới hạn hẹp nhất của thuộc tính và phương thức trong hướng đối tượng. Khi các thuộc tính và phương thức khai báo với giới hạn này thì các thuộc tính phương thức đó chỉ có thể sử dụng được trong class đó, bên ngoài class không thể nào có thể sử dụng được nó kể cả lớp kế thừa nó cũng không sử dụng được, nếu muốn lấy giá trị hoặc gán giá trị ở bên ngoài class thì chúng ta phải thông qua hai hàm SET và GET.

    + Khác với private một chút thì các phương thức và thuộc tính khi khai vào với visibility là protected thì chúng ngoài được sử dụng trong class đó ra thì class con kết thừa từ nó cũng có thể sử dụng được, như bên ngoài class không có thể sử dụng được.

    + Đây là visibility có mức độ truy cập rộng nhất trong hướng đối tượng, khi một thuộc tính hay phương thức sử dụng visibility này thì chúng ta có thể tác động vào thuộc tính hay phương thức đó từ cả trong lẫn ngoài class. Thông thường khi không khai báo visibility thì chương trình dịch tự nhận nó là public nhưng để cho đúng chuẩn thì mọi người lên khai báo từ khóa này vào thay vì bỏ trống.

5. Tính đa hình (polymorphism)

    + Tính đa hình trong lập trình hướng đối tượng là sự đa hình của mỗi hành động cụ thể ở những đối tượng khác nhau. Ví dụ hành động ăn ở các loài động vật hoàn toàn khác nhau như: con heo ăn cám, hổ ăn thịt, con người thì ... ăn hết =)).

    + Đó là sự đa hình trong thực tế, còn đa hình trong lập trình thì được hiểu là Lớp Con sẽ viết lại những phương thức ở lớp cha (ovewrite).

    + Các class cùng implement một interface nhưng chúng có cách thức thực hiện khác nhau cho các method của interface đó.

6. Thế nào là một hàm static. Phân biệt cách dùng từ khoá static::method() với self::method()

6.1. Static là gì?

==> Static trong lập trình hướng đối tượng là một thành phần tĩnh (có thể là thuộc tính hoặc phương thức) mà nó hoạt động như một biến toàn cục, dù cho nó có được xử lý ở trong bất kỳ một file nào đi nữa (trong cùng một chương trình) thì nó đều lưu lại giá trị cuối cùng mà nó được thực hiện vào trong lớp.

Để khai báo một thuộc tính hay một phương thức là static thì chúng ta chỉ việc thêm từ khóa static sau vibsility.
```
   class ClassName
    {
        //khai báo thuộc tính tĩnh
        visibility static $propertyName;
        //Khai báo phương thức tĩnh
        visibility static function methodName()
        {
            //
        }
    }
```
+Khi bạn khai báo một thuộc tính hay một phương thức ở dạng static thì bạn sẽ không thể gọi bằng cách thông thường là dùng từ khóa this được nữa mà sẽ có các
cách gọi khác như sau:

==>Gọi phương thức và thuộc tính tĩnh trong class

-->Để gọi phương thức và thuộc tính tĩnh trong class thì chúng ta có thể sử dụng cú pháp selft::ten hoặc ClassName::ten hoặc static::ten.
```
    class ConNguoi
    {
        private static $name = 'Hoi lam gi';
        public static function getName()
        {
            //gọi thuộc tính tĩnh
            return self::$name;
            //hoặc
            return ConNguoi::$name;
        }

        public function showAll()
        {
            //gọi phương thức tĩnh
            return  self::getName();
            //hoặc 
            return ConNguoi::getName();
        }
    }
```
==>Gọi phương thức và thuộc tính tĩnh ngoài class

-->Để gọi phương thức tĩnh ở bên ngoài class thì chúng ta gọi theo cú pháp ClassName::tenPhuongThuc(), ClassName::$tenthuoctinh.
```
    class ConNguoi
    {
        public static $name = 'Hoi lam gi';
        public static function getName()
        {
            //gọi thuộc tính tĩnh
            return self::$name;
            //hoặc
            return ConNguoi::$name;
        }
        public static function showAll()
        {
            //gọi phương thức tĩnh
            return  self::getName();
            //hoặc 
            return ConNguoi::getName();
        }
    }
    //gọi thuộc tính tĩnh
    ConNguoi::$name;
    //gọi phương thức tĩnh
    ConNguoi::showAll();


Self: Truy xuất đến class khai báo nó.
Static: Truy xuất đến đối tượng hiện tại.
```
# MAGIC METHODS
## Magic methods:
### Magic methods: là các phương thức đặc biệt để tùy biến các các sự kiện trong php. Hiểu đơn giản là nó cung cấp thêm cách để giải quyết một vấn đề.

**Magic methods được dùng để xử lý các đối tượng trong lập trình hướng đối tượng.**

### ?Ưu nhược điểm của magic methods:

### +Ưu điểm:
  Từ khái niệm ở trên chúng ta có thể thấy được ưu điểm của magic methods :
• Giúp cho chúng ta tùy biến được các hành vi, thêm cách lựa chọn để xử lý một đối tượng trong php.

• Nó giúp cho chúng ta có thể thao tác với một đối tượng theo cách mình muốn.

### +Nhược điểm
Từ khái niệm ở trên chúng ta có thể thấy được ưu điểm của magic methods :
• Giúp cho chúng ta tùy biến được các hành vi, thêm cách lựa chọn để xử lý một đối tượng trong php.
• Nó giúp cho chúng ta có thể thao tác với một đối tượng theo cách mình muốn.
• Một magic methods có tốc độ chậm hơn các phương thức bình thường.
I.Các magic method trong PHP.

 +Tất cả các hàm magic methods được viết trong 1 class cụ thể mà khi ta thao tác với đối tượng của class đó mà tùy trường hợp các hàm magic methods ta đã khai báo trong class đó sẽ được thực hiện.

-Trong PHP hiện nay có 15 hàm magic methods:

+__construct(): Hàm được gọi khi ta khởi tạo một đối tượng.

Trong php thì magic method __construct() rất là phổ biến mà chúng ta hay thường gặp nhất. Hàm __construct() sẽ tự đông được gọi khi ta khởi tạo 1 đối tượng

(còn được gọi là hàm khởi tạo).

==> VD
```php 
    <?php 
    class A{
        public $a="Hello World";
        public function __construct($a){
            $this->a = $a;
        }
        public function Greeting(){
            return $this->a;
        }
    }
    ?>
```
-->Không giống như các ngôn ngữ lập trình hướng đối tượng như java hay C#. Trong PHP, hàm khởi tạo không cho phép chúng ta thực hiện việc overload, nó chỉ cho
phép khởi tạo 1 đối tượng duy nhất ứng với method __contructs() được khai báo trong class(không khai báo mặc định là không truyền gì).

+ __destruct():
được gọi khi một đối tượng bị hủy. Mặc định khi kết thúc chương trình hoặc khi ta khai báo mới đối tượng đó sẽ bị hủy bỏ và gọi đến method __destruct().

==> VD
```php
   <?php 
    class A{
        public $a="Hello World";
        public function __construct($a){
            $this->a = $a;
        }
        public function Greeting(){
            return $this->a;
        }
        public function __destruct(){
            echo "huỷ đối tượng".$this->a;
        }
    }
    ?>
```
+ __set():gọi khi ta truyền dữ liệu vào thuộc tính không tồn tại hoặc thuộc tính private trong đối tượng.

==> VD
```php 
   <?php 
    class A{
        public $a="Hello World";
        public function __set($key,$value){
            echo $key->$value;
        }
    }
    $a =new A();
    $a->name = "lò văn đồng";
    echo $a --> 'lò văn đồng';
    class A gọi tới một name không có đc khai báo trong class nên nó sẽ vào hàm set và lấy ra theo $key và $value
    -->Nó truyền dưới dạng key => value. Như ở ví dụ trên, ta set giá trị cho thuộc tính name mà không tồn tại trong class. Nó sẽ gọi đến hàm __set() với $key là thuộc tính đã gọi, $value là giá trị đã gán.
    $key = name;
    $value ="lò văn đồng";
?>
```
+ __get():gọi khi ta truy cập vào thuộc tính không tồn tại hoặc thuộc tính private trong đối tượng. Tương tự như set, get là việc xử lý khi truy cập đối tượng.

==> VD
```php 
   <?php 
    class A{
        public $a="Hello World";
        public function __get($key){
            echo "bạn vừa gọi đến một thuộc tính không tồn tại ".$key;
        }
    }
    $a =new A();
    $a->name;
    ==> kết quả : bạn vừa gọi đến một thuộc tính không tồn tại;
?>
```
+ __isset():
-Phương thức __isset() sẽ được gọi khi chúng ta thực hiện kiểm tra một thuộc tính không được phép truy cập của một đối tượng, hay kiểm tra một thuộc tính không tồn tại trong đối tượng đó. Cụ thể là hàm isset() và hàm empty(). -Chú ý: phương thức __isset() không sử dụng được với thuộc tính tĩnh.

==> VD
```php 
   <?php 
    class A{
        public $a="Hello World";
        public function __isset($name){
            echo "thuộc tính kiểm tra không tồn tại".$name;
        }
    }
    $a =new A();
    isset($a->name);
    ==> kết quả : thuộc tính kiểm tra không tồn tại;
?>
```
+ __unset():
được gọi khi hàm unset() được sử dụng trong một thuộc tính không được phép truy cập. Tương tự như hàm isset. Khi ta Unset 1 thuộc tính không tồn tại thì method 
__unset() sẽ được gọi.

==> VD
```php 
   <?php 
    class A{
        public $a="Hello World";
        public function __unset($name){
            echo "thuộc tính unset không tồn tại".$name;
        }
    }
    $a =new A();
    unset($a->name);
    ==> kết quả : thuộc tính unset không tồn tại;
?>
```
+ __call():được gọi khi ta gọi một phương thức không được phép truy cập trong phạm vi của một đối tượng. Như vậy thì có thể thấy __get() và __call() cũng gần giống nhau. Có điều __get() gọi khi không có thuộc tính còn __call() khi phương thức không có.
Ta cũng có thể dùng hàm __call() để thực hiện overload trong php.
Khai báo : __call($method_name, $parameter)

    +$method_name là phương thức được gọi mà không tồn tại.
    +$parameter: là tham số truyền vào( là mảng).

==> VD
```php 
   <?php 
    class A{
        public $a="Hello World";
        public function __call($method_name,$parameter){
            if($method_name ="test"){
                return $parameter;
            }

        }
    }
    $a =new A();
    $a->test('1');
```
-->Chúng ta có thể thấy trong class A không hề có hàm test. Khi ta gọi tới phương thức test thì nó sẽ chạy hàm __call().
?>

+ __callstatic():

Được kích hoạt khi ta gọi một phương thức không được phép truy cập trong phạm vi của một phương thức tĩnh.

==> VD
```php 
   <?php 
    class A{
        public $a="Hello World";
        public function __callStatic($method_name,$arguments){
           echo "bạn vừa gọi tới phương thức" .$method_name. với các tham số  implode('-',$arguments);
        }

    }
    $a =new A();
    $a::getInfo();
    ==> kết quả là: bạn vừa gọi tới phương thức getInfo() + arguments nếu có
?>
```
+ __toString():
Phương thức này được gọi khi chúng ta in echo đối tượng. Method __toString() sẽ bắt buộc phải trả về 1 dãy String.

==> VD
```php 
   <?php 
    class A{
        public $a="Hello World";
        public function __toString(){
           echo "bạn vừa echo một đối tượng";
           return "return về string";
        }

    }
    $a =new A();
    echo $a;
    ==> kết quả: nó sẽ gọi đến hàm __toString();
?>
```
+ __invoke():
Phương thức này được gọi khi ta cố gắng gọi một đối tượng như một hàm.

==> VD
```php 
   <?php 
    class A{
        public $a="Hello World";
        public function __invoke($name){
           echo $name;
        }

    }
    $a =new A();
    echo $a('lò văn đồng');
?>

```
+ __Sleep():
Được gọi khi serialize() một đối tượng. Thông thường khi chúng ta serialize() một đối tượng thì nó sẽ trả về tất cả các thuộc tính trong đối tượng đó. Nhưng nếu sử dụng __sleep() thì chúng ta có thể quy định được các thuộc tính có thể trả về.

==> VD
```php 
   <?php 
    class A{
        public $a="Hello World";
        public function __sleep($name){
           return array($name);
        }

    }
    echo serialize(new A());
?>
```

+ __wakeup:
Được gọi khi unserialize() đối tượng.


==> VD
```php 
   <?php 
    class A{
        public $a="Hello World";
        public function __sleep($name){
           return "wake up";
        }

    }
 unserialize(serialize(new A()));
?>
```
+ __set_state():
Được sử dụng khi chúng ta var_export một object.

==> VD
```php 
   <?php 
    class A{
        public $a="Hello World";
        public function __set_state($name){
           echo "set_state";
        }

    }
 $a = new A();
 var_export($a);
?>
```
+ __clone():
Được sử dụng khi chúng ta clone(sao chép 1 đối tượng thành 1 đối tượng hoàn toàn mới không liên quan đến đối tượng cũ) một object.

==> VD
```php 
   <?php 
    class A{
        public $a="Hello World";
        public function __clone($name){
           echo "dối tượng mới vừa được tạo";
        }

    }
 $a = new A();
 $b = clone($a);
?>
```
+ __debugInfo():
Được gọi khi chúng ta sử dụng hàm vardump().

==> VD
```php
   <?php 
    class A{
        public $a="Hello World";
        public function __debugInfo(){
           echo "debug!!";
        }

    }
 $a = new A();
 var_dump($a);
?>
```
-----------------------------------------------------Autoload------------------------------------------------------------
--- autoload giúp cho việc quản lí code gọn hơn ta sẽ không phải gọi lại nhiều lần 
I. function  autoload
```php 
<?php 
// common.php
  function sayHello(){
    echo "hello";
  }
?>
```
+tạo một composer.json file với nội dung như sau:
```php 
    {
        "autoload": {
            "files": [
                "./common.php"
            ]
        }
    }
```
- câu lệnh chạy:
  ```
  composer dump-autoload
  ```
+ lúc này ta sẽ nhận được một folder như sau:
```
    📦vendor
    ┣ 📂composer
    ┃ ┣ 📜ClassLoader.php
    ┃ ┣ 📜LICENSE
    ┃ ┣ 📜autoload_classmap.php
    ┃ ┣ 📜autoload_files.php
    ┃ ┣ 📜autoload_namespaces.php
    ┃ ┣ 📜autoload_psr4.php
    ┃ ┣ 📜autoload_real.php
    ┃ ┗ 📜autoload_static.php
    ┗ 📜autoload.php
```
// bên duwois là file common chúng ta đã khai báo ở file composer.json

    // autoload_files.php
    <?php

    // autoload_files.php @generated by Composer

    $vendorDir = dirname(dirname(__FILE__));
    $baseDir = dirname($vendorDir);

    return array(
    '71a289382e4ef3720852310b50d116ea' => $baseDir . '/common.php',
    );

--sử dụng file autoload trong file index.php như sau:

    <?php

    require 'vendor/autoload.php';
     sayHello();
==> như vậy là ta không cần phải dùng các hàm require hay include nữa nó giups cho code ta gọn hơn 


# II. class autoload


vd: ta có một folder chứa class Person.php
```
📦classes
 ┗ 📜Person.php
```
==> để sử dụng autoloadclass ta khai báo vào trong composer.json 
    {
    "autoload": {
        "files": [
            "./common.php"
        ],
        "classmap": [
            "./classes"
        ]
    }
    }
### Sau đó, chạy câu lệnh $ composer dump-autoload, lúc này, ta hãy mở file autoload_classmap xem có gì trong đó:
```php 
    <?php

    // autoload_classmap.php @generated by Composer

    $vendorDir = dirname(dirname(__FILE__));
    $baseDir = dirname($vendorDir);

    return array(
    'Composer\\InstalledVersions' => $vendorDir . '/composer/InstalledVersions.php',
    'Person' => $baseDir . '/classes/Person.php',
    );

```
==> ta thấy base gọi tới 'Person' => $baseDir . '/classes/Person.php',
h muốn sử dụng chỉ cần gọi tới file autoload 

### III.PSR-4

+Sử dụng cái psr-4 này, thì mỗi lần thêm class, ta sẽ không cần phải chạy lại câu lệnh
```php
    {
        "autoload": {
            "psr-4": {
                "App\\": "app/" 
            }
        }
    }
```

#Sự Thay Đổi Của PHP
### php 7.0 support Anonymous Class Support

```php 
new class($i) {
    public function __construct($i) {
        $this->i = $i;
    }
}
```
## Hàm chia số nguyên 
-- cách an toàn để chia (thậm chí cho 0). Nó trả về phép chia số nguyên của toán hạng thứ nhất cho toán hạng thứ hai. Nếu số chia (toán hạng thứ hai) bằng 0, nó sẽ ném E_WARNING và trả về FALSE.

```
 intdiv(int $numerator, int $divisor)
```

## Đã thêm mới toán tử hợp nhất null
```php 
$x = NULL;
$y = NULL;
$z = 3;
var_dump($x ?? $y ?? $z); // int(3)
 
$x = ["c" => "meaningful_value"];
var_dump($x["a"] ?? $x["b"] ?? $x["c"]); // string(16) "meaningful_value"
```
## Đã thêm mới toán tử space ship (<=>) Được sử dụng để tối ưu hóa và đơn giản hóa các phép so sánh.
// Before
```php 
function order_func($a, $b) {
    return ($a < $b) ? -1 : (($a > $b) ? 1 : 0);
}
// Using <=> operator
function order_func($a, $b) {
    return $a <=> $b;
}`

## Khai báo kiểu vô hướng
 Đây chỉ là bước đầu để đạt được ngôn ngữ lập trình mạnh mẽ hơn trong PHP - v0.5.

`
function add(float $a, float $b): float {
    return $a + $b;
}
 
add(1, 2); // float(3)
`
## Khai báo kiểu trả về

Đã thêm khả năng trả về các type ngoài scalar - các class bao gồm cả thừa kế. Vẫn bằng cách nào đó hoàn toàn bỏ lỡ khả năng làm cho nó tùy chọn
`
interface A {
    static function make(): A;
}
class B implements A {
    static function make(): A {
        return new B();
    }
}
```
## Khai báo theo group
```php
// Explicit use syntax:
 
    use FooLibrary\Bar\Baz\ClassA;
    use FooLibrary\Bar\Baz\ClassB;
    use FooLibrary\Bar\Baz\ClassC;
    use FooLibrary\Bar\Baz\ClassD as Fizbo;
    // Grouped use syntax:
    
    use FooLibrary\Bar\Baz\{ ClassA, ClassB, ClassC, ClassD as Fizbo };

```
## Generator Delegation
Cú pháp mới sau đây được cho phép trong phần thân của các hàm generator:
 ```php
 yield from <expr
 ```
# cải thiện hiệu suất
```
 PHP7 nhanh gấp đôi so với PHP5.6
 ```
## PHP 7.1
*Nullable Types

```php 
    function answer(): ?int  {
        return null; //ok
    }

    function answer(): ?int  {
        return 42; // ok
    }

    function answer(): ?int {
        return new stdclass(); // error
    }
    function say(?string $msg) {
        if ($msg) {
            echo $msg;
        }
    }

    say('hello'); // ok -- prints hello
    say(null); // ok -- does not print
    say(); // error -- missing parameter
    say(new stdclass); //error -- bad type

```
## void return 
```php 
function should_return_nothing(): void {
    return 1; // Fatal error: A void function must not return a value
}
```
+ Không giống như các kiểu trả về khác được thi hành khi hàm được gọi, loại này được kiểm tra tại thời gian biên dịch, điều đó có nghĩa là một lỗi được tạo ra mà không cần gọi hàm.
```php 
    function lacks_return(): void {
        // valid
    }

```
## Iterable pseudo type
```php 
 Các tham số được khai báo với iterable có thể sử dụng null hoặc một mảng làm giá trị mặc định.`
```
```php 
function foo(iterable $iterable = []) {
    // ...
}`
```
## Closure from callable
```php 
    class Closure {
        ...
        public static function fromCallable(callable $callable) : Closure {...}
        ...
    }
```
## Cú pháp dấu ngoặc vuông cho phép destructuring assignment mảng
```php 
    $array = [1, 2, 3];
    // Assigns to $a, $b and $c the values of their respective array elements in $array with keys numbered from zero
    [$a, $b, $c] = $array;
    
    // Assigns to $a, $b and $c the values of the array elements in $array with the keys "a", "b" and "c", respectively
    ["a" => $a, "b" => $b, "c" => $c] = $array;
```
## Cú pháp dấu ngoặc vuông cho danh list()
```php 
    $powersOfTwo = [1 => 2, 2 => 4, 3 => 8];
    list(1 => $oneBit, 2 => $twoBit, 3 => $threeBit) = $powersOfTwo;

```
## Class constant visibility
```php 
 class Token {
        // Constants default to public
        const PUBLIC_CONST = 0;
    
            // Constants then also can have a defined visibility
            private const PRIVATE_CONST = 0;
            protected const PROTECTED_CONST = 0;
            public const PUBLIC_CONST_TWO = 0;
    
            //Constants can only have one visibility declaration list
            private const FOO = 1, BAR = 2;
    }
```
## thêm nhiều case trong try catch 

```php 
    try {
    // Some code...
    } catch (ExceptionType1 | ExceptionType2 $e) {
    // Code to handle the exception
    } catch (\Exception $e) {
    // ...
    }
```
 ...vv



# Clean Code

### comment các hàm mà được viết trong class
```
như này giúp lập trình viên khác đọc hiểu code của bạn nhanh chóng

```
#### ví dụ
```php 
 // Chức năng kiểm tra đăng nhập
if(!$user_login){
header("Location:https://www.macronimous.com/");
die();
}
```
### tránh sử dụng câu lệnh không mong muốn

**thay vì viết thế này**
```php 
<?php
If (condition1==true){
code which satisfies the above condition
} else {
perform   die(); or exit();
}
?>
```
**ta hãy viết**
```php
<?
if(!condition){
// display warning message.
die("Invalid statement");
}
?>
```
### thụt đề dõ ràng giúp cho vc phân tầng code đc dõ dàng hơn
### ví dụ

```php 
<?php
If(mysql_num_rows($res)>0) {
    while($a=mysql_fetch_object($res)){
        echo $a->first_name;
    }//ending of while loop
}//ending
```
### Tránh các thẻ html không cần thiết trong mã PHP
**thay vì**
```php
    <?php
    echo "<table>";
    echo “<tr>”;
    echo “<td>”;
    echo “Hai welcome to php”;
    echo “</td>”;
    echo </tr>”;
    echo “</table>”;
    ?>
```
**hãy viết**
```php
    <html>
    <body>
    <table>
    <tr>
    <td><?php echo "Hai welcome to php"; ?></td>
    </tr>
    </body>
    </html>
```

