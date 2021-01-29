# **I - Cookie**
## **1. Tổng quan về Cookie**

### **Khái niệm**
- **Cookie** (hay còn gọi là http cookie, web cookie, Internet cookie, trình duyệt cookie) là những tập tin một trang web gửi đến máy người dùng và được lưu lại thông qua trình duyệt khi người dùng truy cập trang web đó. Cookie được dùng để ghi nhớ thông tin trạng thái (ví dụ, món hàng trong giỏ hàng mua sắm trên một trang thương mại điện tử), ghi nhớ hoạt động người dùng thực hiện trong quá trình truy cập và duyệt một trang web (ví dụ, những nút bấm hay đường liên kết người dùng tương tác). Cookie cũng được dùng để lưu lại các thông tin khác mà người dùng nhập hay điền vào trang web như tên, địa chỉ, mật khẩu, v.v...

### **Session cookie**
- Session cookie chỉ tồn tại trong bộ nhớ tạm thời khi người dùng duyệt web. Thông thường, trình duyệt sẽ xóa bỏ cookie khi người dùng ngưng phiên duyệt web. Không như các loại cookie khác, session cookie không có thời hạn có hiệu lực. Đó cũng là yếu tố để trình duyệt phân biệt session cookie và các loại cookie khác.

### **Persistent cookie**
- Không như Session cookie, Persistent cookie sẽ hết hiệu lực sau một thời điểm nào đó hoặc sau một khoảng thời gian nào đó được ấn định trước. Trong thời gian có hiệu lực của một persistent cookie, thông tin mà persistent cookie lưu lại sẽ được gửi đến máy chủ của website mà người dùng truy cập mỗi khi họ duyệt trang đó, hoặc khi họ truy cập một nguồn tài nguyên thuộc website thông qua một website khác (ví dụ, hình ảnh).

### **Secure cookie**
- Secure cookie chỉ có thể được gửi và nhận qua một kết nối được mã hoá (HTTPS). Các secure cookie không được gửi và nhận qua một kết nối không mã hoá (HTTP).
Http-only cookie
Http-only cookie không được truy cập bởi các giao diện lập trình ứng dụng (API) phía người dùng (client-side APIs) như JavaScript.

### **Same-site cookie**
- Same-site cookie là loại cookie chỉ được gửi qua các yêu cầu xuất phát cùng một tên miền mục tiêu. Same-site cookie ra đời vào 2016 cùng với sự xuất hiện của Google Chrome bản 51.

### **Third-party cookie**
- Thông thường, thông tin về tên miền của một cookie sẽ trùng với tên miền được hiển thị ở thanh địa chỉ của trình duyệt. Đây được gọi là first-party cookie. Khác vậy, một third-party cookie sẽ thuộc một tên miền khác với tên miền trên thanh địa chỉ. Các cookie loại này thường gặp trong trường hợp một website hiển thị thông tin từ các website khác, ví dụ như các banner quảng cáo từ website khác. Third-party cookie được dùng rộng rãi trên web. Theo một khảo sát được thực hiện năm 2018, trong 938,093 trang web phổ biến theo Alexa, hơn 70% số trang được tải xuống có chứa third-party cookie với số lượng hơn 11 cookie mỗi trang tin.

### **Supercookie**
- Supercookie là loại cookie xuất phát từ các tên miền ở tầng cao nhất (ví dụ như .com) hay các hậu tố công cộng (public suffix) như .co.uk. Các loại cookie thông thường khác, ngược lại, xuất phát từ một tên miền, ví dụ như example.com. Supercookie có thể là một mối nguy hiểm tiềm tàng vì các supercookie có thể được dùng để nguỵ trang một yêu cầu không hợp pháp trông như một yêu cầu hợp pháp từ người dùng.

### **Zombie cookie**
- Zombie cookie là loại cookie có thể tự động tái sinh sau khi bị xoá đi.

## **2. Cách thức hoạt động của cookie trên trình duyệt**

![GitHub Logo](https://firebasestorage.googleapis.com/v0/b/slytherin-b4041.appspot.com/o/use-case.png?alt=media&token=edc36046-e96b-4d0c-af18-c64d1c8084d7)

*Một hình ảnh ví dụ về hoạt động của cookie*

Khác với dữ liệu gửi từ form (POST hay GET) thì cookies sẽ được trình duyệt tự động gửi đi theo mỗi lần truy cập lên máy chủ.
Trong quá trình làm việc, cookie có thể bị thay đổi giá trị. Cookie sẽ bị vô hiệu hoá nếu cửa sổ trình duyệt điều khiển cookie đóng lại và cookie hết thời gian có hiệu lực. Theo mặc định, thời gian “sống” của cookies là tồn tại cho đến khi cửa sổ trình duyệt sử dụng cookies bị đóng. Tuy nhiên người ta có thể thiết lập tham số thời gian để cookie có thể sống lâu hơn (6 tháng chẳng hạn). Ví dụ như chế độ Remember ID & Password của 1 số trang web.

### **Giới hạn kích thước của Cookie**

Có 3 loại giới hạn là:

- Số lượng cookie tối đa cho một website
- Dung lượng tối đa cho một cookie
- Dung lượng tối đa cho một website

Ví dụ với số lượng cookie tối đa cho một website = 2, dung lượng tối đa cho một website = 4KB, dung lượng tối đa cho một cookie = 4 KB bạn sẽ có thể có: 1 cookie với dung lượng 4KB, hoặc 2 cookie với dung lượng 1KB và 3KB,....

### **Ưu điểm**

- Giúp việc truy cập Website của người dùng nhanh hơn, tiện lợi hơn, không quá mất nhiều thời gian đăng nhập lại nhiều lần.
Đối với các doanh nghiệp, việc sử dụng Cookie sẽ giúp họ theo dõi được hành vi người dùng, từ đó biết được họ thường truy cập ít hay nhiều, thời gian là bao lâu hay các sở thích khác để có thể tối ưu hóa Website, dịch vụ của mình.
Ngoài ra, việc lưu trữ Cookie đối với các doanh nghiệp sẽ giúp khách hàng của họ thuận tiện hơn trong việc truy cập hay đơn giản là việc nhập liệu ở Website đó trở nên tiện lợi khi các thông tin đã được lưu trữ.

### **Nhược điểm**

- Vì Cookie là một file dùng để lưu trữ các thông tin, hoạt động sử dụng của người dùng mang tính cá nhân vì vậy sẽ dễ dàng bị các Hacker dòm ngó, tìm cách đột nhập hệ thống Website, máy tính cá nhân để lấy cắp thông tin và sử dụng cho các mục đích xấu mà bạn không thể lường trước được.

## **3. Triển khai cài đặt**
- Để sử dụng cookie trong express chúng ta cần phải cài thêm một middleware bên thứ 3 để hỗ trợ việc sử dụng cookie là "cookie-parser", để cài đặt cookie-parser ta mở terminal lên và gõ dòng lệnh :
```javascript
npm install --save cookie-parser
```
Thêm cookie-parser vào Express
- Để có thể sử dụng cookie-parser chúng ta cần thêm middleware này vào trong dự án express của mình bằng cách khai báo sử dụng middleware cookieParse():
```javascript
//Sử dụng express
const express = require('express')
//Sử dụng module cookie-parse
const cookieParser = require('cookie-parser')
//Khởi tạo app express mới
const app = express()
//Khai báo sử dụng middleware cookieParse()
app.use(cookieParser())
```
Chúng ta có thể truyền vào method này 2 tham số :
```javascript
cookieParser(secret, options)
```
- **secret**: Có thể truyền vào đây một chuỗi hoặc một mảng dùng để signed cookie. Đây là trường không bắt buộc, nếu được truyền vào một chuỗi thì sẽ lấy chuỗi đó để sign cookie, một mảng thì tạm thời nó sẽ dùng để unsign cookie theo thứ tự của mảng.
- **options**: truyền vào một object dùng để thêm vàocookie.parse

### **Tạo cookie mới**

Để tạo một cookie mới ta sử dụng cú pháp:
```javascript
res.cookie(name, value, [options])
```
chúng ta có 3 tham số có thể thêm vào :
- **name**: tên của cookie cần thêm vào (bắt buộc)
- **value**: giá trị của cookie (bắt buộc)
- **options**: các tùy chỉnh khác
tham số options là một objects có thể có các thuộc tính như :

| Thuộc tính | Kiểu dữ liệu | Miêu tả |
| ------ | ------ | ------ |
| domain | string | Domain của cookie, thường sẽ là domain của app |
| encode | function | Hàm dùng để encode cookie, mặc định là encodeURIComponent |
| expires | date | Thời điểm và cookie hết hạn, nếu không có giá trị hoặc giá trị bằng 0, nó sẽ tạo ra session cookie |
| httpOnly | boolean | Đánh dấu cookie chỉ có thể truy cập ở máy chủ web |
| maxAge | number | Thời gian hết hạn của cookie so với thời điểm đặt cookie, tính bằng mili giây |
| path | string | path của cookie, mặc định là '/' |
| secure | boolean | Đánh dấu cookie chỉ có thể được sử dụng ở giao thức https |
| signed | boolean | Đánh dấu cookie nên được signed |
| sameSite | boolean hoặc string | Giá trị sameSite của thuộc tính Set-Cookie |

### **Làm ví dụ về cookie**

Chúng ta cùng tạo một ví dụ nhỏ về tạo cookie. Tạo fileindex.js có nội dung như sau:
```javascript
var express = require('express');
var app = express();
var cookieParser = require('cookie-parser');
app.use(cookieParser())
app.get('/cookie', function(req, res){
     res.cookie('name', 'freetuts.net', { expires: new Date(Date.now() + 900000)});
     res.send('success') 
});
app.listen(3000)
```
>mở terminal lên và chạy dòng lệnh:
```javascript
node index
```
sau đó mở trình duyệt và truy cập địa chỉ localhost:3000/cookie, bạn có thể xem cookie của trang web trên trìn duyệt bằng cách mở **Dev Tools -> Application -> Cookies**
![GitHub Logo](https://firebasestorage.googleapis.com/v0/b/slytherin-b4041.appspot.com/o/cookie.png?alt=media&token=2574dab6-b496-488e-b2f3-0a5784b375ba)

### **Lấy giá trị của cookie**

Chúng ta có thể lấy giá trị của cookie bằng cách sử dụng cú pháp :
```javascipt
req.cookie.[name]
```
Khi sử dụng middleware cookie-parser bạn sẽ nhận thêm 1 object trong biến request đó là cookie, tiếp nối ví dụ bên trên mình sẽ lấy giá trị của cookie vừa set.

Thêm một route vào file index.js trong ví dụ trước bằng cách sử dụng :
```javascipt
app.get('/getCookie', function(req, res){
    if (req.cookies.name)
        res.send(`Cookie name co gia tri la ${req.cookies.name}`)
   res.send('Khong the tim lay cookie co ten la name')
});
```
Route này có nhiệm vụ in ra giá trị của cookie name, lúc này file index.js có nội dung như sau :
```javascipt
var express = require('express');
var app = express();
var cookieParser = require('cookie-parser');
app.use(cookieParser())
app.get('/cookie', function(req, res){
     res.cookie('name', 'freetuts.net', { expires: new Date(Date.now() + 900000)});
     res.send('coookie set') 
});
app.get('/getCookie', function(req, res){
    if (req.cookies.name)
        res.send(`Cookie name co gia tri la ${req.cookies.name}`)
   res.send('Khong the tim lay cookie co ten la name')
});
app.listen(3000)
```
mở terminal và sử dụng lệnh
```javascipt
node index
```
Trên trình duyệt bạn gõ địa chỉ localhost:3000/getCookieđể xem kết quả. Nếu bạn cookie có tên 'name' đã được lưu trữ trên trình duyệt rồi thì nó sẽ hiện ra giá trị của cookie,
```javascipt
Cookie name co gia tri la freetuts.net
```
ngược lại sẽ hiển thi :
```javascipt
Khong the tim lay cookie co ten la name
```
**Xóa cookie hiện có**

Để xóa cookie ta sẽ sử dụng phương thức `clearCookie` và truyền vào đó 2 tham số, tham số thứ nhất là tên cookie mà bạn muốn xóa, tham số thứ 2 là 1 object các tùy chỉnh.
```javascipt
res.clearCookie(cookieName, [options]);
```
### **Ví dụ như :**
```javascipt
app.get('/deleteCookie', function(req, res){
   res.clearCookie('name');
   res.send('Da xoa cookie')
});
```

# II - Tìm hiểu về csrf token (Nodejs, csurf)
Trong các ứng dụng hiện nay thường hay sử dụng JWT để xác thực(authentication) và ủy quyền(authorization) token xác thực sẽ được lưu vào một http-Only cookie trên trình duyệt của người dùng. Điều này sẽ làm đơn giản hóa code ở front-end vì nó không phải theo dõi token(cookie tự động gửi bởi trình duyệt theo mỗi request)

Tuy nhiên việc sử dụng cookie để xác thực khiến cho ứng dụng dễ bị tấn công CSRF. Cùng tìm hiểu về CSRF, cách tấn công CSRF và cách giảm thiểu lỗ hổng bảo mật

![hacker](https://images.viblo.asia/0eea3ebb-a900-46b3-ab7b-3e25845689d7.jpg)
* ## Cơ bản về csrf
  CSRF ( Cross Site Request Forgery) là kĩ thuật tấn công bằng cách sử dụng quyền chứng thực của người sử dụng đối với 1 website khác. Các ứng dụng web hoạt động theo cơ chế nhận các câu lệnh HTTP từ người sử dụng, sau đó thực thi các câu lệnh này.
  hí
* ## Kịch bản tấn công
  #### Một cuộc tấn công CSRF vào một trang web(ví dụ: app.com) sử dụng cookie để xác thực có thể xảy ra theo cách sau:
  * Người dùng truy cập trang web app.com để thực hiện thanh toán, chuyển tiền... và chưa thực hiện logout để kết thúc.
  * Người dùng truy cập vào trang web độc hại (hacker.com) bằng trình duyệt của mình.
  * Trang web độc hại sẽ chứa một request ẩn với trang web bị nhắm đến(app.com). 
    > Ví dụ: Nó có thể là một thẻ img hay thẻ form bị ẩn gọi đến request "api/transfer_money?to=hackerman&amount=10000" để yêu cầu chuyển tiền của người dùng vào tài khoản của hacker
  ```html
  <img height="0" width="0" src="http://www.webapp.com/project/1/destroy">
  <iframe height="0" width="0" src="http://www.webapp.com/project/1/destroy">
  <link ref="stylesheet" href="http://www.webapp.com/project/1/destroy" type="text/css"/>
  <bgsound src="http://www.webapp.com/project/1/destroy"/>
  <background src="http://www.webapp.com/project/1/destroy"/>
  <script type="text/javascript" src="http://www.webapp.com/project/1/destroy"/>
  ```
  * Trình duyệt của nạn nhân sẽ tự động đính kèm cookie mà nó có cho app.com. Cookie xác thực sẽ được đính kèm với reuquest.
  * Nhìn từ phía của server, đây là một yêu cầu hợp lệ, cho lên request sẽ đc thực hiện thành công.
  * Như vậy kẻ tấn công có thể thử dụng CSRF để chay bất cứ yêu cầu nào với trang web mà trang web không thể phân biệt được request nào là hợp pháp hay không.
* ## Cách phòng chống các cuộc tấn công CSRF
  Dựa trên nguyên tắc của CSRF “lừa trình duyệt của người dùng (hoặc người dùng) gửi các câu lệnh HTTP”, các kĩ thuật phòng tránh sẽ tập trung vào việc tìm cách phân biệt và hạn chế các câu lệnh giả mạo.
  ### Giải pháp:
  Chúng ta cần đặt giá trị bổ xung(token) chuyển đến máy chủ để tăng tính xác thực của request
  * Khi người dùng truy cập trang web(app.com) lần đầu tiên, server sẽ đặt một SCRF cookie.
  * Cookie này chỉ được đọc bằng JavaScript code trên app.com.
  * Coolie cần được gửi trở lại server theo hai cách khác nhau: dưới dạng cookie và dưới dạng header. Việc thêm nó vào header là trách nhiệm của front-end và đảm bảo request là chính xác(không có mã bên ngoài nào có thể đặt đc request đó).
  
  ### Thư viện csurf hoạt động hơi khác một chút, chúng ta có thể xem ví dụ sau đây:
  ### Phía server(sử dụng thư viện csurf)

   * ### Cài đặt:
  ```
  $ npm install csurf
  ```
    * #### Code:
    app.js
  ```javascript
  import createError from 'http-errors';
  import express from 'express';
  import path from 'path';
  import cookieParser from 'cookie-parser';
  import logger from 'morgan';

  import testRouter from './routes/test';

  //tạo express app
  const app = express();

  app.use(logger('dev'));
  app.use(express.json());
  app.use(express.urlencoded({ extended: true }));
  app.use(cookieParser());
  app.use(express.static(path.join(__dirname, 'public')));

  //sử dụng router test
  app.use('/test', testRouter);

  // catch 404 and forward to error handler
  app.use(function(req, res, next) {
    next(createError(404));
  });

  // error handler
  app.use(function(err, req, res, next) {
    // set locals, only providing error in development
    res.locals.message = err.message;
    res.locals.error = req.app.get('env') === 'development' ? err : {};

    // render the error page
    res.status(err.status || 500);
    res.json({message: 'error: ' + err});
  });

  export default app;
  ```
    test.js
  ```javascript
  import express from 'express';
  import csurf from 'csurf'
  //cài đặt router middleware
  const csrfMiddleware = csurf({
     cookie: true
  })

  //tạo router
  const router = express.Router();

  router.get('/gettoken', csrfMiddleware, (request, response) => {
  //trả về csrfToken 
     response.json({
          csrf: request.csrfToken()
     })
  })

  router.post('/', csrfMiddleware, (request, response) => {
     response.json({
          message: 'chào bạn!'
     })
  })

  export default router;
  ```
   Như đã thấy ở trên ví dụ có 2 api:
    
     * '/test/gettoken': một GET api đơn giản chỉ trả về cookie xác thực
     * '/test': một POST api trả về dữ liệu cho người dùng ở đây là message: 'chào bạn'
   ### Giao tiếp giữa client và server
   Trong request đầu tiên, server sẽ gửi cho client hai cookie là _csrf và XSRF-Token:
     * _csrf được tạo tự động khi ta để {cookie: true}. Đây là bí mật và không phải là CSRF-Token. Server sẽ sử dụng cái này để khớp với mã token thực sự. Cookie _csrf là một giải pháp thay thế cho việc sử dụng session: thay vì lưu chữ bí mật này ở máy chủ, gắn với user session thì lưu trữ nó trên trình duyệt của người dùng dưới dạng cookie
     * XSRF-Token. Đây là CSRF token. Chúng ta cần tạo nó bắng cách thủ công với hàm request.csrfToken(). Nó cần được gửi cho client trong lần request đầu tiên(có thể thực hiện bằng nhiều cách như đặt nó làm cookie hoặc trả về cho client bằng response như ví dụ trên...). Client cần gửi lại nó trong body, query string hoặc header trong mỗi request.
     
   Gọi GET api 'test/getttoken' để lấy ra XSRF-Token
   ![csrf-get](https://firebasestorage.googleapis.com/v0/b/slytherin-b4041.appspot.com/o/csrf-get.png?alt=media&token=905d8f57-f8e8-4f5d-9c40-f951ed79395e)
   _csrf sẽ được lưu ở cookie
   ![csrf-cookie](https://firebasestorage.googleapis.com/v0/b/slytherin-b4041.appspot.com/o/csrf-cookie.png?alt=media&token=786c5b79-84eb-4b6e-ba12-19a956e7a0ca)
   Trường hợp client gửi lại XSRF-Token trong body(sử dụng param tên là _csrf)
   ![csrf-body](https://firebasestorage.googleapis.com/v0/b/slytherin-b4041.appspot.com/o/csrf-body.png?alt=media&token=560fca6f-cbe5-45f3-ba73-a41d5b9d8664)
   Trường hợp client gửi lại XSRF-Token trong query string(sử dụng param tên là _csrf)
   ![csrf-query](https://firebasestorage.googleapis.com/v0/b/slytherin-b4041.appspot.com/o/csrf-query.png?alt=media&token=e0d0e6a1-67dd-4831-b0d9-67bdd64e064a)
   Trường hợp client gửi lại XSRF-Token trong header(sử dụng param tên là CSRF-Token hoặc XSRF-Token)
   ![csrf-header](https://firebasestorage.googleapis.com/v0/b/slytherin-b4041.appspot.com/o/csrf-header.png?alt=media&token=30973f7d-eaa2-41da-8472-db727952df75)
   Trường hợp XSRF-Token thiếu, bị sai hoặc _csrf thiếu, bị sai
   ![csrf-log](https://firebasestorage.googleapis.com/v0/b/slytherin-b4041.appspot.com/o/csrf-log.png?alt=media&token=451d7476-9b55-449a-a7da-6820f32f2655)
   Đối với GET request:
     * Bảo vệ CSRF là không cần thiết.
   Đối với POST/PATCH/PUT/DELETE request:
     * Phải thêm csrfProtection middleware trên server code.
     * Server sẽ kiểm tra cookie _csrf do client gửi về và XSRF-Token cũng do client gửi về trong body, query string hoặc header trong mỗi request.
   ### Những điều cần xem xét
     * XSRF-TOKEN có thể sẽ được client gửi lại dưới dạng cookie (do cách thức hoạt động của cookie), nhưng server sẽ bỏ qua nó, vì nó sẽ chỉ tìm kiếm nó trong body, query string hoặc header trong mỗi request.
     * Mã tạo token(request.csrfToken()) chỉ nên được chạy một lần khi GET request '/' gốc chạy lần đầu tiên
     * ...
     
   Tài liệu tham khảo:

   https://freetuts.net/cookie-trong-expresss-2203.html

   https://expressjs.com/en/resources/middleware/cookie-parser.html

   https://medium.com/@d.silvas/how-to-implement-csrf-protection-on-a-jwt-based-app-node-csurf-angular-bb90af2a9efd
   
   https://securitydaily.net/csrf-phan-1-nhung-hieu-ve-biet-chung-ve-csrf/
   
   http://expressjs.com/en/resources/middleware/csurf.html