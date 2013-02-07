아마도상 2012 홈페이지
================

설명
--------------------------------------
2012년 "아마도"의 200일을 기념하여 만든 "아마도상"의 홈페이지 소스입니다.

설치
--------------------------------------
이 프로그램은 rewrite 모듈이 필요합니다.
아래는 nginx환경에서 실제로 사용했던 nginx.conf 의 한 부분입니다.
사용에 참고해주세요.

<pre>
server {
        listen       80;
        server_name  award.amado.kr;

        location / {
            root   /home/award_2012/;
            index  index.php index.html index.htm;
            if (-f $request_filename) {
                access_log off;
                expires max;

                break;
            }

            rewrite ^(.*)$ /index.php?/$1 last;
        }

        error_page   500 502 503 504  /50x.html;
        location = /50x.html {
            root   html;
        }

        client_max_body_size 3m;

        location ~ \.php$ {
            root           /home/award_2012/;
            fastcgi_pass   unix:/tmp/php-fpm.sock;
            fastcgi_index  index.php;
            fastcgi_param  SCRIPT_FILENAME  /home/award_2012/$fastcgi_script_name;
            include        fastcgi_params;
            fastcgi_buffers 4 320k;
            fastcgi_buffer_size 192k;
        }

        location ~ /\.ht {
            deny  all;
        }
    }
</pre>
