# 食品栄養学 研究管理システム
栄養学の研究を行うためのシステム。
## 機能
- 学生による食事内容の投稿
- 研究生によるプロジェクトごとの食事内容の閲覧
- 管理者によるプロジェクト・研究生・学生の管理
- CSVアップロードによる学生ユーザーデータの一括登録
## 認証に関する機能
ユーザーには下記の役割が存在する

- レポート投稿者
  - 登録用ページから登録可能
  - 自分の投稿内容だけ閲覧・編集が可能
- 研究生
  - 投稿者の内容を閲覧可能
  - 管理者によるアカウント登録
- 管理者
  - すべての情報を閲覧可能
  - 研究生のアカウント登録
  - 調査（プロジェクト）の閲覧と新規登録、編集
## 設計
![image](https://github.com/hagiohagi/shokujikanri_app/assets/68381420/988d56ef-e7b2-4004-9484-3619f7d8681b)  
![image](https://github.com/hagiohagi/shokujikanri_app/assets/68381420/15631ecb-615e-45e2-a116-f28539236401)  
## テーブル構成
![image](https://github.com/hagiohagi/shokujikanri_app/assets/68381420/13097eb1-2bd8-447e-a93e-e5b0b7df457f)
## 使用した技術
PHP 8.0
Laravel 7.29  
Vue 2.5  
Bootstrap 4.0  
