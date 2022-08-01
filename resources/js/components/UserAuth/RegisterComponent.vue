<template>
    <div>
        <!----- [ APIテストボタン ] --------------------->
        <div v-if="test.form" class="card card-body mb-3">

            <h2 class="text-danger fw-bold">APIテスト</h2>

            <div class="d-flex flex-wrap">

                <form :action="api_route.step01" method="post" class="mb-3 me-3">
                    <input v-for="(value, name) in input.step01" :key="name" :name="name" :value="value" type="hidden">
                    <button type="submit" class="btn btn-danger text-white">ステップ01テスト</button>
                </form>

                <form :action="api_route.step02" method="post" class="mb-3 me-3">
                    <input v-for="(value, name) in input.step02" :key="name" :name="name" :value="value"  type="hidden">
                    <button type="submit" class="btn btn-danger text-white">ステップ02テスト</button>
                </form>

                <form :action="api_route.step03" method="post" class="mb-3 me-3">
                    <input v-for="(value, name) in input.step03" :key="name" :name="name" :value="value"  type="hidden">
                    <button type="submit" class="btn btn-danger text-white">ステップ03テスト</button>
                </form>

                <form :action="api_route.step04" method="post" class="mb-3 me-3">
                    <input v-for="(value, name) in {...this.input.step01, ...this.input.step02, ...this.input.step03}"
                    :key="name" :name="name" :value="value"  type="hidden">
                    <button type="submit" class="btn btn-danger text-white">ステップ04テスト</button>
                </form>

                <form :action="route.login" method="post" class="mb-3 me-3">
                    <input type="hidden" :value="token" name="_token">
                    <input v-for="(value, name) in {...this.input.step02, ...this.input.step03}"
                    :key="name" :name="name" :value="value" type="hidden">
                    <button type="submit" class="btn btn-danger text-white">ログイン</button>
                </form>

            </div>
        </div>
        <!------------------------------------------------>


        <!----- [ ステップ１ ] ----->
        <div v-if="card_num===1" class="anima-fadein-bottom">
            <div class="card shadow w-100 p-3 mb-3">
                <div class="card-body">

                    <h3 class="text-secondary fw-bold mb-3">{{ '会員登録' }}</h3>

                    <h5 class="mb-5 text-primary fw-bold">
                        ステップ１/５
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped bg-primary" role="progressbar"
                            style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </h5>


                    <div class="mb-3">
                        <label for="name01">{{ '氏　名' }}</label>
                        <div class="row">
                            <!-- 苗字 -->
                            <div class="col-6">
                                <input id="name01" type="name" class="form-control" v-model="input.step01.name01"
                                name="name01" required autocomplete="name01" autofocus placeholder="苗字">

                                <div v-if="errors.step01.name01">
                                    <div v-for="(error, key) in errors.step01.name01" :key="key" class="text-danger"
                                    role="alert">※{{ error }}</div>
                                </div>
                            </div>
                            <!-- 名前 -->
                            <div class="col-6">
                                <input id="name02" type="name" class="form-control" v-model="input.step01.name02"
                                name="name02" required autocomplete="name02" autofocus placeholder="名前">

                                <div v-if="errors.step01.name02">
                                    <div v-for="(error, key) in errors.step01.name02" :key="key" class="text-danger"
                                    role="alert">※{{ error }}</div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="mb-5">
                        <label for="kana_name01">{{ 'ふりがな' }}</label>
                        <div class="row">
                            <!-- みようじ -->
                            <div class="col-6">
                                <input id="kana_name01" type="name" class="form-control me-2"  v-model="input.step01.kana_name01"
                                name="kana_name01" required autocomplete="kana_name01" autofocus placeholder="みようじ">

                                <div v-if="errors.step01.kana_name01">
                                    <div v-for="(error, key) in errors.step01.kana_name01" :key="key" class="text-danger"
                                    role="alert">※{{ error }}</div>
                                </div>
                            </div>
                            <!-- なまえ -->
                            <div class="col-6">
                                <input id="kana_name02" type="name" class="form-control" v-model="input.step01.kana_name02"
                                name="kana_name02" required autocomplete="kana_name02" autofocus placeholder="なまえ">

                                <div v-if="errors.step01.kana_name02">
                                    <div v-for="(error, key) in errors.step01.kana_name02" :key="key" class="text-danger"
                                    role="alert">※{{ error }}</div>
                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="mb-3">
                        <label for="gender">{{ '性別' }}</label>
                        <div >
                            <select id="gender" name="gender" class="form-select" v-model="input.step01.gender" required>
                                <option value="">選択してください</option>
                                <option value="女性">女性</option>
                                <option value="男性">男性</option>
                                <option value="その他">その他</option>
                            </select>
                        </div>
                        <div v-if="errors.step01.gender">
                            <div v-for="(error, key) in errors.step01.gender" :key="key" class="text-danger"
                            role="alert">※{{ error }}</div>
                        </div>
                    </div>



                    <div class="mb-5">
                        <label for="barthday">{{ '誕生日' }}</label>
                        <input id="barthday" type="date" name="barthday" class="form-control" v-model="input.step01.barthday"
                        :max="form_option.max_barthday" required autocomplete="barthday" autofocus>
                        <div v-if="errors.step01.barthday">
                            <div v-for="(error, key) in errors.step01.barthday" :key="key" class="text-danger"
                            role="alert">※{{ error }}</div>
                        </div>
                    </div>


                    <div class="card border-light  mb-5">
                        <div class="card-body text-center">
                            <div class="card-title fw-bold  text-center">個人情報の取り扱いについて</div>
                            <p class="card-text" style="font-size:11px;">
                                <a href="#" @click.prevent="windowOpen(route.privacy_policy)">プライバシーポリシー</a>

                                をご確認ください。<br>
                                同意いただけた場合のみ次のステップへお進みください。
                            </p>
                        </div>
                    </div>



                    <div class="row mb-3">
                        <div class="col-sm-8 offset-sm-2">
                            <button type="button" @click="nextToStep01"
                            class="btn btn-arrow btn-curve btn-success text-white w-100">
                                {{ '次のステップへ　進む' }}
                            </button>
                        </div>
                    </div>



                </div>
            </div>
        </div>
        <!----- [ ステップ２ ] ----->
        <div v-if="card_num===2" class="anima-fadein-bottom">
            <div class="card shadow w-100 p-3 mb-3">
                <div class="card-body">


                    <h3 class="text-secondary fw-bold mb-3">{{ '会員登録' }}</h3>

                    <h5 class="mb-5 text-primary fw-bold">
                        ステップ２/５
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped bg-primary" role="progressbar" style="width: 40%"
                            aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </h5>


                    <div class="mb-3">
                        <label for="email">{{ 'メールアドレス' }}</label>
                        <input id="email" type="email" class="form-control" v-model="input.step02.email" name="email"
                        required autocomplete="email" autofocus>

                        <div v-if="errors.step02.email">
                            <div v-for="(error, key) in errors.step02.email" :key="key" class="text-danger"
                            role="alert">※{{ error }}</div>
                        </div>
                    </div>


                    <div class="mb-5">
                        <label for="tell">{{ '電話番号（半角数字、ハイフンなし）' }}</label>
                        <input id="tell" type="tell" class="form-control" v-model="input.step02.tell" name="tell"
                        required autocomplete="tell" autofocus>

                        <div v-if="errors.step02.tell">
                            <div v-for="(error, key) in errors.step02.tell" :key="key" class="text-danger"
                            role="alert">※{{ error }}</div>
                        </div>
                    </div>


                    <div class="mb-3">
                        <label for="address01">{{ '住所（都道府県）' }}</label>
                        <select id="address01" name="address01" class="form-select w-50"
                        v-model="input.step02.address01" required>
                            <option value="">選択してください</option>
                            <option  v-for="(todohuken, key) in form_option.todohukens" :key="key"
                            :value="todohuken">{{ todohuken }}</option>
                        </select>
                        <div v-if="errors.step02.address01">
                            <div v-for="(error, key) in errors.step02.address01" :key="key" class="text-danger"
                            role="alert">※{{ error }}</div>
                        </div>
                    </div>


                    <div class="mb-5">
                        <label for="address02">{{ '住所（市町村・番地・建物名）' }}</label>
                        <input id="address02" type="text" name="address02" class="form-control"
                        v-model="input.step02.address02" required autocomplete="address02" autofocus>
                        <div v-if="errors.step02.address02">
                            <div v-for="(error, key) in errors.step02.address02" :key="key" class="text-danger"
                            role="alert">※{{ error }}</div>
                        </div>
                    </div>


                    <div class="row mb-3">
                        <div class="col-sm-8 offset-sm-2 mb-3">
                            <button type="button" @click="nextToStep02"
                            class="btn btn-arrow btn-curve btn-success text-white w-100">
                                {{ '次のステップへ　進む' }}
                            </button>
                        </div>

                        <div class="col-sm-8 offset-sm-2">
                            <button @click="subCardNum" type="button"
                            class="btn btn-arrow btn-curve btn-secondary text-white w-100">
                                {{ '前のステップへ　戻る' }}
                            </button>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <!----- [ ステップ３ ] ----->
        <div v-if="card_num===3" class="anima-fadein-bottom">
            <div class="card shadow w-100 p-3 mb-3">
                <div class="card-body">


                    <h3 class="text-secondary fw-bold mb-3">{{ '会員登録' }}</h3>

                    <h5 class="mb-5 text-primary fw-bold">
                        ステップ３/５
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped bg-primary" role="progressbar" style="width: 60%"
                            aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </h5>


                    <div class="mb-5">
                        <p class="bg-light p-3">
                            入力されたメールアドレス宛にメールをお送りしました。<br>
                            メールに記載された6ケタの認証番号を入力してください。
                        </p>

                        <label for="verification_code">{{ '認証番号（半角数字）' }}</label>
                        <input id="verification_code" type="text" class="form-control w-50" name="verification_code"
                        v-model="input.step03.verification_code" required autocomplete="current-verification_code">

                        <div v-if="errors.step03.verification_code">
                            <div v-for="(error, key) in errors.step03.verification_code" :key="key" class="text-danger"
                            role="alert">※{{ error }}</div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="d-flex justify-content-between align-items-center">
                            {{ 'パスワード' }}
                            <a href="" class="btn btn-link" @click.prevent="toggleDisplayPassword"
                            style="font-size:.5rem; text-decoration:none;">{{ form_option.input_password.text }}</a>
                        </label>
                        <p class="mb-0" style="font-size:.8rem;">※8文字以上20文字以下の半角英数字</p>

                        <input id="password" class="form-control" name="password"
                        :type="form_option.input_password.type"
                        v-model="input.step03.password" required autocomplete="current-password">

                        <div v-if="errors.step03.password">
                            <div v-for="(error, key) in errors.step03.password" :key="key" class="text-danger"
                            role="alert">※{{ error }}</div>
                        </div>
                    </div>

                    <div class="mb-5">
                        <label for="password_confirmation">{{ 'パスワードの確認' }}</label>
                        <p class="mb-0" style="font-size:.8rem;">※8文字以上20文字以下の半角英数字</p>

                        <input id="password_confirmation" class="form-control" name="password_confirmation"
                        :type="form_option.input_password.type"
                        v-model="input.step03.password_confirmation" required autocomplete="current-password_confirmation">

                        <div v-if="errors.step03.password_confirmation">
                            <div v-for="(error, key) in errors.step03.password_confirmation" :key="key" class="text-danger" role="alert">※{{ error }}</div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-8 offset-sm-2 mb-3">
                            <button type="button" @click="nextToStep03"
                            class="btn btn-arrow btn-curve btn-success text-white w-100">
                                {{ '次のステップへ　進む' }}
                            </button>
                        </div>

                        <div class="col-sm-8 offset-sm-2">
                            <button @click="subCardNum" type="button"
                            class="btn btn-arrow btn-curve btn-secondary text-white w-100">
                                {{ '前のステップへ　戻る' }}
                            </button>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <!----- [ ステップ４ ] ----->
        <div v-if="card_num===4" class="anima-fadein-bottom">
            <div class="card shadow w-100 p-3 mb-3">
                <div class="card-body">


                    <h3 class="text-secondary fw-bold mb-3">{{ '会員登録' }}</h3>

                    <h5 class="mb-5 text-primary fw-bold">
                        ステップ４/５
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped bg-primary" role="progressbar" style="width: 80%"
                            aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </h5>

                    <div class="card border-light  mb-5">
                        <div class="card-body">
                            <h5 class="card-title fw-bold  text-center mb-3">入力内容の確認</h5>
                            <p class="bg-light p-3">
                                入力内容にお間違いなければ登録完了へお進みください。<br>
                                ※登録内容はマイページから変更可能です。
                            </p>
                            <div class="row mb-3">
                                <div class="col-md-4 fw-bold">氏　名</div>
                                <div class="col-md-8 text-secondary">{{input.step01.name01}}　{{input.step01.name02}}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4 fw-bold">ふりがな</div>
                                <div class="col-md-8 text-secondary">{{input.step01.kana_name01}}　{{input.step01.kana_name02}}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4 fw-bold">性別</div>
                                <div class="col-md-8 text-secondary">{{input.step01.gender}}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4 fw-bold">誕生日</div>
                                <div class="col-md-8 text-secondary">{{input.step01.barthday}}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4 fw-bold">メールアドレス</div>
                                <div class="col-md-8 text-secondary">{{input.step02.email}}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4 fw-bold">電話番号</div>
                                <div class="col-md-8 text-secondary">{{input.step02.tell}}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4 fw-bold">住所</div>
                                <div class="col-md-8 text-secondary">{{input.step02.address01}}{{input.step02.address02}}</div>
                            </div>

                        </div>
                    </div>


                    <div class="row mb-3">
                        <div class="col-sm-8 offset-sm-2 mb-3">
                            <button type="button" @click="nextToStep04" class="btn btn-arrow btn-curve btn-success text-white w-100">
                                {{ '次のステップへ　進む' }}
                            </button>
                        </div>

                        <div class="col-sm-8 offset-sm-2">
                            <button @click="subCardNum" type="button" class="btn btn-arrow btn-curve btn-secondary text-white w-100">
                                {{ '前のステップへ　戻る' }}
                            </button>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <!----- [ ステップ５ ] ----->
        <div v-if="card_num===5" class="anima-fadein-bottom">
            <div class="card shadow w-100 p-3 mb-3">
                <div class="card-body">


                    <h3 class="text-secondary fw-bold mb-3">{{ '会員登録' }}</h3>

                    <h5 class="mb-5 text-primary fw-bold">
                        ステップ５/５
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped bg-primary" role="progressbar"
                            style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </h5>

                    <h5 class="text-secondary fw-bold mb-3 text-center">会員登録が完了しました。</h5>

                    <h3 class="text-secondary fw-bold mb-3 text-center">
                        ようこそ、{{input.step01.name01}}　{{input.step01.name02}}さん！
                    </h3>

                    <div class="row mt-5 mb-3">
                        <div class="col-md-8 offset-md-2">
                            <form :action="route.login" method="post" class="mb-3 me-3">

                                <input type="hidden" :value="token" name="_token"> <!-- token -->
                                <input v-for="(value, name) in {...this.input.step02, ...this.input.step03}"
                                :key="name" :name="name" :value="value" type="hidden">

                                <button type="submit"
                                class="btn btn-arrow btn-curve btn-primary text-white w-100">{{ 'マイページへ' }}</button>

                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>




    </div>
</template>

<script>
    export default {
        data : function() {
            return{

                /* test用フォーム・データの利用 */
                test : { form : false, data : false, },


                /* token ( ログイン処理のページ遷移時に利用 )*/
                token : document.querySelector('[name="csrf_token"]').content,

                /* ルート */
                api_route : {
                    step01 : document.querySelector('[name="api_route_step01"]').content,
                    step02 : document.querySelector('[name="api_route_step02"]').content,
                    step03 : document.querySelector('[name="api_route_step03"]').content,
                    step04 : document.querySelector('[name="api_route_step04"]').content,
                },
                route : {
                    login : document.querySelector('[name="route_login"]').content,// ログイン
                    privacy_policy : document.querySelector('[name="route_privacy_policy"]').content, //プライバシーポリシー
                },


                /* 表示中カード番号 */
                card_num : 1,


                /* 入力内容 */
                input : {

                    step01 : {
                        name01 : '',name02: '',
                        kana_name01: '',kana_name02: '',
                        gender : '', barthday : '',
                    },

                    step02 : {
                        email: '',tell: '',
                        address01 : '', address02 : '',
                        created_verification_code : '', //認証コードメール送信の有無
                    },

                    step03 : {
                        verification_code : '',//認証コード(入力)
                        verification_code_confirmation : '',//認証コード
                        password : '',
                        password_confirmation : '',
                    },

                },
                /* エラー内容 */
                errors : {
                    step01 : {},
                    step02 : {},
                    step03 : {},
                },

                /* オプションデータ */
                form_option : {
                    // 誕生日の最大値
                    max_barthday : this.maxBarthday(),

                    // 都道府県
                    todohukens : {
                        1 : '北海道',
                        2 : '青森県',
                        3 : '岩手県',
                        4 : '宮城県',
                        5 : '秋田県',
                        6 : '山形県',
                        7 : '福島県',
                        8 : '茨城県',
                        9 : '栃木県',
                        10 : '群馬県',
                        11 : '埼玉県',
                        12 : '千葉県',
                        13 : '東京都',
                        14 : '神奈川県',
                        15 : '新潟県',
                        16 : '富山県',
                        17 : '石川県',
                        18 : '福井県',
                        19 : '山梨県',
                        20 : '長野県',
                        21 : '岐阜県',
                        22 : '静岡県',
                        23 : '愛知県',
                        24 : '三重県',
                        25 : '滋賀県',
                        26 : '京都府',
                        27 : '大阪府',
                        28 : '兵庫県',
                        29 : '奈良県',
                        30 : '和歌山県',
                        31 : '鳥取県',
                        32 : '島根県',
                        33 : '岡山県',
                        34 : '広島県',
                        35 : '山口県',
                        36 : '徳島県',
                        37 : '香川県',
                        38 : '愛媛県',
                        39 : '高知県',
                        40 : '福岡県',
                        41 : '佐賀県',
                        42 : '長崎県',
                        43 : '熊本県',
                        44 : '大分県',
                        45 : '宮崎県',
                        46 : '鹿児島県',
                        47 : '沖縄県',
                    },

                    // パスワード入力の表示形式
                    input_password :{
                        type : 'password', text : 'パスワードを表示',
                    }
                },

            }
        },
        mounted() { //* テスト用入力データの挿入 */

            if( this.test.data ){
                this.input = {

                    step01 : {
                        name01 : '山田',name02: '太郎',
                        kana_name01: 'やまだ',kana_name02: 'たろう',
                        gender : '男性', barthday : '1999-09-09',
                    },

                    step02 : {
                        email: 'aek1214@yahoo.co.jp',
                        tell: '0312345678',
                        address01 : '東京都', address02 : '練馬区ススキが原',
                        created_verification_code : '', //認証コードメール送信の有無
                    },

                    step03 : {
                        verification_code : '',//認証コード
                        verification_code_confirmation : '',//認証コード(入力)
                        password : 'password',
                        password_confirmation : 'password',
                    },
                };
            }

            // console.log('register_form.')


        },
        methods:{
            /* ステップ01の次へメソッド */
            nextToStep01 :function(){

                // [ 非同期通信 ]
                fetch(this.api_route.step01, {

                    method: 'POST',
                    body: new URLSearchParams(this.input.step01),

                })
                .then(response => {
                    if(!response.ok){ alert('データ送信エラーが発生しました。'); }
                    return response.json();
                })
                // [ 非同期通信・成功処理 ]
                .then(json => {
                    if(!json.errors) //[ バリデーション・成功 ]
                    {
                        this.addCardNum();
                        this.errors.step01 = {};
                        // console.log( json );
                    }
                    else //[ バリデーション・失敗 ]
                    {
                        this.errors.step01 = json.errors;
                        // console.log( this.errors.step01 );
                    }
                })

            },
            /* ステップ02の次へメソッド */
            nextToStep02 :function(){

                // [ 非同期通信 ]
                fetch(this.api_route.step02, {

                    method: 'POST',
                    body: new URLSearchParams(this.input.step02),

                })
                .then(response => {
                    if(!response.ok){ alert('データ送信エラーが発生しました。'); }
                    return response.json();
                })
                // [ 非同期通信・成功処理 ]
                .then(json => {
                    if(!json.errors) //[ バリデーション・成功 ]
                    {
                        this.addCardNum();
                        this.errors.step02 = {};

                        // 認証コードの保存
                        if( json.verification_code ){
                            this.input.step03.verification_code_confirmation = json.verification_code;
                            this.input.step02.created_verification_code = true; //認証コード：送信済み
                        }
                        // console.log( json );
                    }
                    else //[ バリデーション・失敗 ]
                    {
                        this.errors.step02 = json.errors;
                        // console.log( this.errors.step02 );
                    }
                })

            },
            /* ステップ03の次へメソッド */
            nextToStep03 :function(){

                // [ 非同期通信 ]
                fetch(this.api_route.step03, {

                    method: 'POST',
                    body: new URLSearchParams(this.input.step03),

                })
                .then(response => {
                    if(!response.ok){ alert('データ送信エラーが発生しました。'); }
                    return response.json();
                })
                // [ 非同期通信・成功処理 ]
                .then(json => {
                    if(!json.errors) //[ バリデーション・成功 ]
                    {
                        this.addCardNum();
                        this.errors.step03 = {};
                        // console.log( json );
                    }
                    else //[ バリデーション・失敗 ]
                    {
                        this.errors.step03 = json.errors;
                        // console.log( this.errors.step03 );
                    }
                })

            },
            /* ステップ04の次へメソッド */
            nextToStep04 :function(){

                // 送信データ
                const input_step04 = {...this.input.step01, ...this.input.step02, ...this.input.step03};

                // [ 非同期通信 ]
                fetch(this.api_route.step04, {

                    method: 'POST',
                    body: new URLSearchParams(input_step04),

                })
                .then(response => {
                    if(!response.ok){ alert('データ送信エラーが発生しました。'); }
                    return response.json();
                })
                // [ 非同期通信・成功処理 ]
                .then(json => {

                    this.addCardNum();
                    // console.log( json );

                })

            },


            /* 次へメソッド */
            addCardNum : function(){
                this.card_num ++;
                window.scroll({top: 0, behavior: 'smooth'});
            },


            /* 前へメソッド */
            subCardNum : function(){
                this.card_num --;
                window.scroll({top: 0, behavior: 'smooth'});
            },


            /* 入力できる誕生日の最大値 */
            maxBarthday : function(){
                const now =new Date();
                const max_year = now.getFullYear() - 15;
                return  max_year+'-12-31';
            },


            /* パスワード入力の表示切替 */
            toggleDisplayPassword : function(){

                let type = this.form_option.input_password.type;
                if( type === 'password' )
                {
                    this.form_option.input_password.text = 'パスワードを非表示';
                    this.form_option.input_password.type = 'text';
                }
                else
                {
                    this.form_option.input_password.text = 'パスワードを表示';
                    this.form_option.input_password.type = 'password';
                }
            },


            /* 別タブでページを開く */
            windowOpen : function(url){
                window.open(url, '_blank');
            }
        }
    }
</script>
