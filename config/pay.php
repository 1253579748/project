<?php

return   

        [  
                //应用ID,您的APPID。
                'app_id' => "2016101500689566",

                //商户私钥
                'merchant_private_key' => "MIIEpAIBAAKCAQEAsqflgqiBl782pdR8pxtae361heGPRv1b1hiR9XrIaf+eka3P3DRbCiHF/2OpnGfSmaZ6U20+40N8RRksE2gY4lN7ECkd2wed7qPQLnoMwlAmm73g3Sc3OtQZH9gaSaP5Qx77qcS4TNeYFryf5wO9v17450ho0MDGrll0ULjX7X9oQJQARCQe2eiLuCfP/oWKfkk0dzfyB5npFIWLvagZyxO9ELPXqB/IFRPKGNuIBCvqUkc3IRki7VhyLs83KwYMpO6dFftX8UazCWy5JjThVFuzsBqM1WCZRcuA8aY+hp+tG01EarTRR9ez206kFRXLL1AcDnQ9t2wVu8LMn7gMZwIDAQABAoIBAGoYKMSx2tvJ0uMhz7DRHqet9JCABb0Lomj/CFa2RqQkB//NL14+vT3EFrf2cHgQc9GJOqWmf60om3jRXQpdTEHDf5Z2RGOZH2HjaDLhiggu3u6oEQxkSHkoEY+Gnv3SYalJkfwcdbI0af4+n9rprtohxUBcENq/UH2jY964ForTmQnHSF3EF7OH2Wd3na/YUup9iYMaoLs62i6abMov+3wjblbNAtdZKvrVX7HNyV0DuRgMYX+8cGfDyICGaH0WnxW9KDf90KZQJY3ntzU38ByGpSVz+w7j3doCDxDPlhHe16GimteQPQAfzDjfFYl/N2rvzdvFsp9TuICsojWLHpECgYEA9iVc3akDrzchyAVe/gdiIk48y50sSlwyScBJmGYkfgFuAOcUamc6h03KhFs8gMl03mK5jcj4VHWUbbY9KgYPjOQV8CeOeLD9ZfLj0TdDT33bRK08gFk7Yvaj/TmjU5M65zVv8x6YE8rxPkzMbFfkvlOc8SEqTv0jirjNIiDUTS8CgYEAuc7by58M9MxvtUp+bmUNfCBJAQEd1JVdjJKlhxS7Rz/dEGOrUlx53MAZ2Y/HEOS1zy2vDZ8aRhwEjoXne7adFGvrVj+kBbydLoBG8zOWlXjr4+CwQEJmUGCw9ocncDTopAhN3CceTv4CiZMyU/5Hux2FqFCmGqkPfsSK1lk0FkkCgYBoRAFnf72ozfDIWsYXUydVotCL66MkSJOgvAwwuyvAGHjxdvEl9V5MjD45/K/PWgbgYO96yOOwWzIpmyWjlHen1cIZPZhTNZ3RPqcUK5WeqZBlMgDL2YCXdiSXEoBF2br8z50BXjdLQw8Xtc5uInkpyh9T4Rmb5gzVKVzzlPZ5TwKBgQCsZdErmXRFAhY3qFmshhg/7hiuVOHfp4K39iydK9Aj6I5tMXz5GxJ6jsatRSjXdM134BRG2DNhj4du0bEY6TPPid4+FShTplBUn/K0nk3+e8aqlYQS60jRFRW8d2RRSNX9tDLBrI4Djsy95xRQOGNHqrmjlMi5fdkBrsx+2x9n+QKBgQDB7fWITI1OdnZg4tdm6tIVAWPxrbmXpA2d3TepIB0Q0S3HltWkqZf4tDPxfv0tp3JNZVpGnVVVpEujSVnJLuu7JW8Xg1Npi0CitxsNjWoOi1nSS6pjuqkjWkLY1jGAED9lWQFkkxwD0gT12VFGylQ42FZwQniJicLE9XfbTsUpJg==",
                
                //异步通知地址
                'notify_url' => "http://phpon.cn/admin/pay/payNotify",
                
                //同步跳转
                'return_url' => "http://phpon.cn/home/index",

                //编码格式
                'charset' => "UTF-8",

                //签名方式
                'sign_type'=>"RSA2",

                //支付宝网关
                'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

                //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
                'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAlSfDyuPyDEKHjaBaWWMrCI8ATajr8JvGa4yaVxvPGBRGbrecz/EaLVhzVUdDv9BbaJ+hQU7O56mTKK4D6r6L4oYyMoRS40dGTD3lQ8ZjSsOemLVHXr8bk7s8LDiky0s66FGz2rpMkDVxaphgPEaW5RzXr2S5yRs+I9qpcNVGLEaqNa5CAdFel9eYVtiVSdqBm4AVn9sG1aqCDbpBjwnNYPiGyohQeSMx3BXALSdfO1zK0d8guUuycawBL3QXWfd0ocj1ZqqFakD424Zk/hFHjoXiOZRXxfNsvuPqAKMrhSMYTxIQdwUCqoZ3E8PxrWtDapisCrtM/1VzzKI4jCOTlwIDAQAB",
        ];