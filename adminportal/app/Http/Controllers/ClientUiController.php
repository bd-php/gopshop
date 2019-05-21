<?php
/**
 * Created by PhpStorm.
 * User: Nazibul
 * Date: 5/21/2019
 * Time: 9:30 AM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientUiController extends Controller
{
    public $apiName;
    public $data;

    public function __construct(Request $request)
    {
        $ipClient = $request->ip();
        $method = $request->method();
        $headers = getallheaders();
        $this->apiName = $headers['Apiname'] ?? '';
        $this->data = $request->all();
    }

    /**
     * Return the index page html.
     *
     * @param
     * @return array
     */
    public function index()
    {
        $htmlstr = <<<HTML
        
<header class="header">
    <ul>
        <li><a href="javascript:void();"><img src="images/search.svg" alt=""> </a></li>
        <li><a href="javascript:void();" onclick="go_to_index('header_logo'); return false;"><img src="images/logo-icon.svg" alt=""> </a></li>
        <li><a href="javascript:void();" class="notify" onclick="go_to_notification('header_notification'); return false;"><img src="images/icon-bell.svg" alt=""> </a></li>
    </ul>
</header>

<div class="inner">

    <div class="home-carousel">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="story-box">
                        <a href="">
                            <div class="story-img">
                                <img src="images/story-img-01.jpg" alt="">
                                <p>
                                    <span>ভৌতিক </span>
                                    <span>১৩+</span>
                                </p>
                            </div>
                            <div class="story-box-content">
                                <h3>নায়িকা যেভাবে খুন হলো</h3>
                                <span>অনার্য তাপস </span>
                                <ul>
                                    <li><img src="images/star.svg" alt=""></li>
                                    <li><img src="images/star.svg" alt=""></li>
                                    <li><img src="images/star.svg" alt=""></li>
                                    <li><img src="images/star-half.svg" alt=""></li>
                                    <li><img src="images/star-line.svg" alt=""></li>
                                    <li>৩.৫</li>
                                </ul>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="story-box">
                        <a href="">
                            <div class="story-img">
                                <img src="images/story-img-01.jpg" alt="">
                                <p>
                                    <span>ভৌতিক </span>
                                    <span>১৩+</span>
                                </p>
                            </div>
                            <div class="story-box-content">
                                <h3>নায়িকা যেভাবে খুন হলো</h3>
                                <span>অনার্য তাপস </span>
                                <ul>
                                    <li><img src="images/star.svg" alt=""></li>
                                    <li><img src="images/star.svg" alt=""></li>
                                    <li><img src="images/star.svg" alt=""></li>
                                    <li><img src="images/star-half.svg" alt=""></li>
                                    <li><img src="images/star-line.svg" alt=""></li>
                                    <li>৩.৫</li>
                                </ul>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="story-box">
                        <a href="">
                            <div class="story-img">
                                <img src="images/story-img-01.jpg" alt="">
                                <p>
                                    <span>ভৌতিক </span>
                                    <span>১৩+</span>
                                </p>
                            </div>
                            <div class="story-box-content">
                                <h3>নায়িকা যেভাবে খুন হলো</h3>
                                <span>অনার্য তাপস </span>
                                <ul>
                                    <li><img src="images/star.svg" alt=""></li>
                                    <li><img src="images/star.svg" alt=""></li>
                                    <li><img src="images/star.svg" alt=""></li>
                                    <li><img src="images/star-half.svg" alt=""></li>
                                    <li><img src="images/star-line.svg" alt=""></li>
                                    <li>৩.৫</li>
                                </ul>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
        </div>
    </div>

    <div class="home-category">
        <h2>গল্পের টাইপ <a href="">আরও দেখুন</a></h2>
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="category-box">
                        <a href="category.html">
                            <img src="images/category-img-01.jpg" alt="">
                        </a>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="category-box">
                        <a href="category.html">
                            <img src="images/category-img-02.jpg" alt="">
                        </a>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="category-box">
                        <a href="category.html">
                            <img src="images/category-img-01.jpg" alt="">
                        </a>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="category-box">
                        <a href="category.html">
                            <img src="images/category-img-02.jpg" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="popular-slider">
        <h2>জনপ্রিয় গল্প</h2>
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="story-box">
                        <a href="">
                            <div class="story-img">
                                <img src="images/story-img-01.jpg" alt="">
                                <p>
                                    <span>ভৌতিক </span>
                                    <span>১৩+</span>
                                </p>
                            </div>
                            <div class="story-box-content">
                                <h3>নায়িকা যেভাবে খুন হলো</h3>
                                <span>অনার্য তাপস </span>
                                <ul>
                                    <li><img src="images/star.svg" alt=""></li>
                                    <li><img src="images/star.svg" alt=""></li>
                                    <li><img src="images/star.svg" alt=""></li>
                                    <li><img src="images/star-half.svg" alt=""></li>
                                    <li><img src="images/star-line.svg" alt=""></li>
                                    <li>৩.৫</li>
                                </ul>
                            </div>
                            <div class="story-length">
                                <div class="circle-point">
                                    <svg class="circle-round" viewbox="0 0 100 100" width=24 height="24"
                                         data-percent="37">
                                        <circle cx="50" cy="50" r="40"/>
                                    </svg>
                                </div>
                                ৩৭%
                            </div>
                        </a>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="story-box">
                        <a href="">
                            <div class="story-img">
                                <img src="images/story-img-01.jpg" alt="">
                                <p>
                                    <span>ভৌতিক </span>
                                    <span>১৩+</span>
                                </p>
                            </div>
                            <div class="story-box-content">
                                <h3>নায়িকা যেভাবে খুন হলো</h3>
                                <span>অনার্য তাপস </span>
                                <ul>
                                    <li><img src="images/star.svg" alt=""></li>
                                    <li><img src="images/star.svg" alt=""></li>
                                    <li><img src="images/star.svg" alt=""></li>
                                    <li><img src="images/star-half.svg" alt=""></li>
                                    <li><img src="images/star-line.svg" alt=""></li>
                                    <li>৩.৫</li>
                                </ul>
                            </div>
                            <div class="story-length">
                                <div class="circle-point">
                                    <svg class="circle-round" viewbox="0 0 100 100" width=24 height="24"
                                         data-percent="37">
                                        <circle cx="50" cy="50" r="40"/>
                                    </svg>
                                </div>
                                ৩৭%
                            </div>
                        </a>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="story-box">
                        <a href="">
                            <div class="story-img">
                                <img src="images/story-img-01.jpg" alt="">
                                <p>
                                    <span>ভৌতিক </span>
                                    <span>১৩+</span>
                                </p>
                            </div>
                            <div class="story-box-content">
                                <h3>নায়িকা যেভাবে খুন হলো</h3>
                                <span>অনার্য তাপস </span>
                                <ul>
                                    <li><img src="images/star.svg" alt=""></li>
                                    <li><img src="images/star.svg" alt=""></li>
                                    <li><img src="images/star.svg" alt=""></li>
                                    <li><img src="images/star-half.svg" alt=""></li>
                                    <li><img src="images/star-line.svg" alt=""></li>
                                    <li>৩.৫</li>
                                </ul>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="story-box">
                        <a href="">
                            <div class="story-img">
                                <img src="images/story-img-01.jpg" alt="">
                                <p>
                                    <span>ভৌতিক </span>
                                    <span>১৩+</span>
                                </p>
                            </div>
                            <div class="story-box-content">
                                <h3>নায়িকা যেভাবে খুন হলো</h3>
                                <span>অনার্য তাপস </span>
                                <ul>
                                    <li><img src="images/star.svg" alt=""></li>
                                    <li><img src="images/star.svg" alt=""></li>
                                    <li><img src="images/star.svg" alt=""></li>
                                    <li><img src="images/star-half.svg" alt=""></li>
                                    <li><img src="images/star-line.svg" alt=""></li>
                                    <li>৩.৫</li>
                                </ul>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<footer class="footer">
    <ul>
        <li>
            <a href="javascript:void();" onclick="go_to_index('tab_home'); return false;" class="active">
                <img src="images/home.svg" alt="">হোম</a>
        </li>
        <li>
            <a href="javascript:void();" onclick="go_to_category('tab_category'); return false;">
                <img src="images/story-type.svg" alt="">গল্পের টাইপ </a>
        </li>
        <li>
            <a href="javascript:void();" onclick="go_to_favourite('tab_favourite'); return false;">
                <img src="images/heart.svg" alt="">
                আমার প্রিয়</a>
        </li>
        <li>
            <a href="javascript:void();" onclick="go_to_profile('tab_profile'); return false;">
                <img src="images/user.svg" alt="">প্রোফাইল </a>
        </li>
    </ul>
</footer>

HTML;

        return ['code' => '900', 'data' => $htmlstr];
    }

    /**
     * Return the category page html.
     *
     * @param
     * @return array
     */
    public function category()
    {
        $htmlstr = <<<HTML
<header class="header">
    <ul>
        <li> <a href="javascript:void();" onclick="go_to_back('header_back'); return false;"><img src="images/back.svg" alt=""> </a> </li>
        <li>ভৌতিক </li>
        <li> <a class="notify" href="javascript:void();" onclick="go_to_notification('header_notification'); return false;"><img src="images/icon-bell.svg" alt=""> </a> </li>
    </ul>
</header>

<div class="category">
    <div class="story-box">
        <a href="javascript:void();" onclick="showModal('age-modal')">
            <div class="story-img">
                <img src="images/story-img-01.jpg" alt="">
                <h5 class="selected">নির্বাচিত গল্প</h5>
                <p>
                    <span>ভৌতিক </span>
                    <span>১৩+</span>
                </p>
            </div>
            <div class="story-box-content">
                <h3>নায়িকা যেভাবে খুন হলো</h3>
                <span>অনার্য তাপস </span>
                <ul>
                    <li> <img src="images/star.svg" alt=""> </li>
                    <li> <img src="images/star.svg" alt=""> </li>
                    <li> <img src="images/star.svg" alt=""> </li>
                    <li> <img src="images/star-half.svg" alt=""> </li>
                    <li> <img src="images/star-line.svg" alt=""> </li>
                    <li>৩.৫</li>
                </ul>
            </div>
            <div class="story-length">
                <div class="circle-point">
                    <svg class="circle-round" viewbox="0 0 100 100" width=24 height="24" data-percent="80">
                        <circle cx="50" cy="50" r="40" />
                    </svg>
                </div>
                ৮০%
            </div>
        </a>
    </div>
    <div class="story-box">
        <a href="">
            <div class="story-img">
                <img src="images/story-img-02.jpg" alt="">
                <p>
                    <span>ভৌতিক </span>
                    <span>১৩+</span>
                </p>
            </div>
            <div class="story-box-content">
                <h3>নায়িকা যেভাবে খুন হলো</h3>
                <span>অনার্য তাপস </span>
                <ul>
                    <li> <img src="images/star.svg" alt=""> </li>
                    <li> <img src="images/star.svg" alt=""> </li>
                    <li> <img src="images/star.svg" alt=""> </li>
                    <li> <img src="images/star-half.svg" alt=""> </li>
                    <li> <img src="images/star-line.svg" alt=""> </li>
                    <li>৩.৫</li>
                </ul>
            </div>
            <div class="story-length full">
                <div class="circle-point">
                    <svg class="circle-round" viewbox="0 0 100 100" width=24 height="24" data-percent="100">
                        <circle cx="50" cy="50" r="40" />
                    </svg>
                </div>
                ১০০%
            </div>
        </a>
    </div>
    <div class="story-box">
        <a href="">
            <div class="story-img">
                <img src="images/story-img-01.jpg" alt="">
                <p>
                    <span>ভৌতিক </span>
                    <span>১৩+</span>
                </p>
            </div>
            <div class="story-box-content">
                <h3>নায়িকা যেভাবে খুন হলো</h3>
                <span>অনার্য তাপস </span>
                <ul>
                    <li> <img src="images/star.svg" alt=""> </li>
                    <li> <img src="images/star.svg" alt=""> </li>
                    <li> <img src="images/star.svg" alt=""> </li>
                    <li> <img src="images/star-half.svg" alt=""> </li>
                    <li> <img src="images/star-line.svg" alt=""> </li>
                    <li>৩.৫</li>
                </ul>
            </div>
            <div class="story-length">
                <div class="circle-point">
                    <svg class="circle-round" viewbox="0 0 100 100" width=24 height="24" data-percent="37">
                        <circle cx="50" cy="50" r="40" />
                    </svg>
                </div>
                ৩৭%
            </div>
        </a>
    </div>
</div>

<footer class="footer">
    <ul>
        <li>
            <a href="javascript:void();" onclick="go_to_index('tab_home'); return false;">
                <img src="images/home.svg" alt="">হোম</a>
        </li>
        <li>
            <a href="javascript:void();" onclick="go_to_category('tab_category'); return false;" class="active">
                <img src="images/story-type.svg" alt="">গল্পের টাইপ </a>
        </li>
        <li>
            <a href="javascript:void();" onclick="go_to_favourite('tab_favourite'); return false;">
                <img src="images/heart.svg" alt="">
                আমার প্রিয়</a>
        </li>
        <li>
            <a href="javascript:void();" onclick="go_to_profile('tab_profile'); return false;">
                <img src="images/user.svg" alt="">প্রোফাইল </a>
        </li>
    </ul>
</footer>

<div class="modal age-modal" id="age-modal">
    <div class="modal-inner">
        <img src="images/18+.svg" alt="">
        <p>এই গল্পটি ১৮+ বয়সীদের জন্য। দয়া করে আপনার বয়স নিশ্চিত করুন।</p>
        <a class="btn-white" href="javascript:void();" onclick="hideModal('age-modal')">বাতিল</a>
        <a class="btn-common" href="">নিশ্চিত করুন</a>
    </div>
</div>

HTML;

        return ['code' => '900', 'data' => $htmlstr];
    }

    /**
     * Return the favourite page html.
     *
     * @param
     * @return array
     */
    public function favourite()
    {
        $htmlstr = <<<HTML
        
<header class="header">
    <ul>
        <li> <a href="javascript:void();" onclick="go_to_back('header_back'); return false;"><img src="images/back.svg" alt=""> </a> </li>
        <li>আমার প্রিয়</li>
        <li> <a class="notify" href="javascript:void();" onclick="go_to_notification('header_notification'); return false;"><img src="images/icon-bell.svg" alt=""> </a> </li>
    </ul>
</header>

<div class="category">
    <div class="sorting">
        <select name="">
            <option value="">সম্পূর্ণ</option>
            <option value="">অসম্পূর্ণ</option>
            <option value="">নতুন যোগ করা</option>
            <option value="">সবচে পছন্দনীয়</option>
        </select>

    </div>
    <div class="story-box">
        <a href="javascript:void();" onclick="showModal('age-modal')">
            <div class="story-img">
                <img src="images/story-img-01.jpg" alt="">
                <h5 class="selected">নির্বাচিত গল্প</h5>
                <p>
                    <span>ভৌতিক </span>
                    <span>১৩+</span>
                </p>
            </div>
            <div class="story-box-content">
                <h3>নায়িকা যেভাবে খুন হলো</h3>
                <span>অনার্য তাপস </span>
                <ul>
                    <li><img src="images/star.svg" alt=""></li>
                    <li><img src="images/star.svg" alt=""></li>
                    <li><img src="images/star.svg" alt=""></li>
                    <li><img src="images/star-half.svg" alt=""></li>
                    <li><img src="images/star-line.svg" alt=""></li>
                    <li>৩.৫</li>
                </ul>
            </div>
            <div class="story-length">
                <div class="circle-point">
                    <svg class="circle-round" viewbox="0 0 100 100" width=24 height="24" data-percent="80">
                        <circle cx="50" cy="50" r="40"/>
                    </svg>
                </div>
                ৮০%
            </div>
        </a>
    </div>
    <div class="story-box">
        <a href="">
            <div class="story-img">
                <img src="images/story-img-02.jpg" alt="">
                <p>
                    <span>ভৌতিক </span>
                    <span>১৩+</span>
                </p>
            </div>
            <div class="story-box-content">
                <h3>নায়িকা যেভাবে খুন হলো</h3>
                <span>অনার্য তাপস </span>
                <ul>
                    <li><img src="images/star.svg" alt=""></li>
                    <li><img src="images/star.svg" alt=""></li>
                    <li><img src="images/star.svg" alt=""></li>
                    <li><img src="images/star-half.svg" alt=""></li>
                    <li><img src="images/star-line.svg" alt=""></li>
                    <li>৩.৫</li>
                </ul>
            </div>
            <div class="story-length full">
                <div class="circle-point">
                    <svg class="circle-round" viewbox="0 0 100 100" width=24 height="24" data-percent="100">
                        <circle cx="50" cy="50" r="40"/>
                    </svg>
                </div>
                ১০০%
            </div>
        </a>
    </div>
    <div class="story-box">
        <a href="">
            <div class="story-img">
                <img src="images/story-img-01.jpg" alt="">
                <p>
                    <span>ভৌতিক </span>
                    <span>১৩+</span>
                </p>
            </div>
            <div class="story-box-content">
                <h3>নায়িকা যেভাবে খুন হলো</h3>
                <span>অনার্য তাপস </span>
                <ul>
                    <li><img src="images/star.svg" alt=""></li>
                    <li><img src="images/star.svg" alt=""></li>
                    <li><img src="images/star.svg" alt=""></li>
                    <li><img src="images/star-half.svg" alt=""></li>
                    <li><img src="images/star-line.svg" alt=""></li>
                    <li>৩.৫</li>
                </ul>
            </div>
            <div class="story-length">
                <div class="circle-point">
                    <svg class="circle-round" viewbox="0 0 100 100" width=24 height="24" data-percent="37">
                        <circle cx="50" cy="50" r="40"/>
                    </svg>
                </div>
                ৩৭%
            </div>
        </a>
    </div>
</div>

<footer class="footer">
    <ul>
        <li>
            <a href="javascript:void();" onclick="go_to_index('tab_home'); return false;">
                <img src="images/home.svg" alt="">হোম</a>
        </li>
        <li>
            <a href="javascript:void();" onclick="go_to_category('tab_category'); return false;">
                <img src="images/story-type.svg" alt="">গল্পের টাইপ </a>
        </li>
        <li>
            <a href="javascript:void();" onclick="go_to_favourite('tab_favourite'); return false;" class="active">
                <img src="images/heart.svg" alt="">
                আমার প্রিয়</a>
        </li>
        <li>
            <a href="javascript:void();" onclick="go_to_profile('tab_profile'); return false;">
                <img src="images/user.svg" alt="">প্রোফাইল </a>
        </li>
    </ul>
</footer>

<div class="modal age-modal" id="age-modal">
    <div class="modal-inner">
        <img src="images/18+.svg" alt="">
        <p>এই গল্পটি ১৮+ বয়সীদের জন্য। দয়া করে আপনার বয়স নিশ্চিত করুন।</p>
        <a class="btn-white" href="javascript:void();" onclick="hideModal('age-modal')">বাতিল</a>
        <a class="btn-common" href="">নিশ্চিত করুন</a>
    </div>
</div>

HTML;

        return ['code' => '900', 'data' => $htmlstr];
    }

    /**
     * Return the profile page html.
     *
     * @param
     * @return array
     */
    public function profile()
    {
        $htmlstr = <<<HTML
        
<div class="profile-top">
    <ul>
        <li>
            <img src="images/user.png" alt="">
            <h3>আবুল হোসেন <span>৫৭ টি গল্প পড়েছেন</span></h3>
        </li>
        <li>
            <a href="javascript:void();" onclick="showModal('leader-modal')"><img src="images/cup.svg" alt=""> </a>
        </li>
    </ul>
</div>

<div class="category profile">
    <div class="sorting-parent">
        <h3>আপনার গল্প</h3>
        <div class="sorting">
            <select name="">
                <option value="">সম্পূর্ণ</option>
                <option value="">অসম্পূর্ণ</option>
                <option value="">নতুন যোগ করা</option>
                <option value="">সবচে পছন্দনীয়</option>
            </select>
        </div>
    </div>
    <div class="story-box">
        <a href="javascript:void();" onclick="showModal('age-modal')">
            <div class="story-img">
                <img src="images/story-img-01.jpg" alt="">
                <h5 class="selected">নির্বাচিত গল্প</h5>
                <p>
                    <span>ভৌতিক </span>
                    <span>১৩+</span>
                </p>
            </div>
            <div class="story-box-content">
                <h3>নায়িকা যেভাবে খুন হলো</h3>
                <span>অনার্য তাপস </span>
                <ul>
                    <li><img src="images/star.svg" alt=""></li>
                    <li><img src="images/star.svg" alt=""></li>
                    <li><img src="images/star.svg" alt=""></li>
                    <li><img src="images/star-half.svg" alt=""></li>
                    <li><img src="images/star-line.svg" alt=""></li>
                    <li>৩.৫</li>
                </ul>
            </div>
            <div class="story-length">
                <div class="circle-point">
                    <svg class="circle-round" viewbox="0 0 100 100" width=24 height="24" data-percent="80">
                        <circle cx="50" cy="50" r="40"/>
                    </svg>
                </div>
                ৮০%
            </div>
        </a>
    </div>
    <div class="story-box">
        <a href="">
            <div class="story-img">
                <img src="images/story-img-02.jpg" alt="">
                <p>
                    <span>ভৌতিক </span>
                    <span>১৩+</span>
                </p>
            </div>
            <div class="story-box-content">
                <h3>নায়িকা যেভাবে খুন হলো</h3>
                <span>অনার্য তাপস </span>
                <ul>
                    <li><img src="images/star.svg" alt=""></li>
                    <li><img src="images/star.svg" alt=""></li>
                    <li><img src="images/star.svg" alt=""></li>
                    <li><img src="images/star-half.svg" alt=""></li>
                    <li><img src="images/star-line.svg" alt=""></li>
                    <li>৩.৫</li>
                </ul>
            </div>
            <div class="story-length full">
                <div class="circle-point">
                    <svg class="circle-round" viewbox="0 0 100 100" width=24 height="24" data-percent="100">
                        <circle cx="50" cy="50" r="40"/>
                    </svg>
                </div>
                ১০০%
            </div>
        </a>
    </div>
    <div class="story-box">
        <a href="">
            <div class="story-img">
                <img src="images/story-img-01.jpg" alt="">
                <p>
                    <span>ভৌতিক </span>
                    <span>১৩+</span>
                </p>
            </div>
            <div class="story-box-content">
                <h3>নায়িকা যেভাবে খুন হলো</h3>
                <span>অনার্য তাপস </span>
                <ul>
                    <li><img src="images/star.svg" alt=""></li>
                    <li><img src="images/star.svg" alt=""></li>
                    <li><img src="images/star.svg" alt=""></li>
                    <li><img src="images/star-half.svg" alt=""></li>
                    <li><img src="images/star-line.svg" alt=""></li>
                    <li>৩.৫</li>
                </ul>
            </div>
            <div class="story-length">
                <div class="circle-point">
                    <svg class="circle-round" viewbox="0 0 100 100" width=24 height="24" data-percent="37">
                        <circle cx="50" cy="50" r="40"/>
                    </svg>
                </div>
                ৩৭%
            </div>
        </a>
    </div>
</div>

<footer class="footer">
    <ul>
        <li>
            <a href="javascript:void();" onclick="go_to_index('tab_home'); return false;">
                <img src="images/home.svg" alt="">হোম</a>
        </li>
        <li>
            <a href="javascript:void();" onclick="go_to_category('tab_category'); return false;">
                <img src="images/story-type.svg" alt="">গল্পের টাইপ </a>
        </li>
        <li>
            <a href="javascript:void();" onclick="go_to_favourite('tab_favourite'); return false;">
                <img src="images/heart.svg" alt="">
                আমার প্রিয়</a>
        </li>
        <li>
            <a href="javascript:void();" onclick="go_to_profile('tab_profile'); return false;" class="active">
                <img src="images/user.svg" alt="">প্রোফাইল </a>
        </li>
    </ul>
</footer>

<div class="modal leader-modal" id="leader-modal">
    <div class="modal-inner">
        <span class="modal-close" onclick="hideModal('leader-modal')">×</span>
        <h4>লিডারবোর্ড</h4>
        <div class="leader-list">
            <ul>
                <li>
                    <img src="images/user.png" alt="">
                    <h3>আবুল হোসেন <span>৫৭ টি গল্প পড়েছেন</span></h3>
                </li>
                <li>
                    <span>4</span> <img src="images/cup.svg" alt="">
                </li>
            </ul>
            <ul>
                <li>
                    <img src="images/user.png" alt="">
                    <h3>আবুল হোসেন <span>৫৭ টি গল্প পড়েছেন</span></h3>
                </li>
                <li>
                    <span>4</span> <img src="images/cup.svg" alt="">
                </li>
            </ul>
            <ul>
                <li>
                    <img src="images/user.png" alt="">
                    <h3>আবুল হোসেন <span>৫৭ টি গল্প পড়েছেন</span></h3>
                </li>
                <li>
                    <span>2</span> <img src="images/cup.svg" alt="">
                </li>
            </ul>
            <ul>
                <li>
                    <img src="images/user.png" alt="">
                    <h3>আবুল হোসেন <span>৫৭ টি গল্প পড়েছেন</span></h3>
                </li>
                <li>
                    <span>04</span> <img src="images/cup.svg" alt="">
                </li>
            </ul>
            <ul>
                <li>
                    <img src="images/user.png" alt="">
                    <h3>আবুল হোসেন <span>৫৭ টি গল্প পড়েছেন</span></h3>
                </li>
                <li>
                    <span>04</span> <img src="images/cup.svg" alt="">
                </li>
            </ul>
        </div>
    </div>
</div>

HTML;

        return ['code' => '900', 'data' => $htmlstr];
    }

    /**
     * Return the notification page html.
     *
     * @param
     * @return array
     */
    public function notification()
    {
        $htmlstr = <<<HTML
<header class="header">
    <ul>
        <li> <a href="javascript:void();" onclick="go_to_back('header_back'); return false;"><img src="images/back.svg" alt=""> </a> </li>
        <li>নোটিফিকেশন</li>
        <li></li>
    </ul>
</header>

<div class="notification">
    <div class="notification-box">
        <span class="close-notify"></span>
        <h3>নতুন গল্প এসেছে। এখনই পড়ুন! 😃</h3>
        <p>৩২ মিনিট আগে</p>
    </div>
    <div class="notification-box">
        <span class="close-notify"></span>
        <h3>গল্প ১ পরিবর্তন হয়েছে!</h3>
        <p>৩২ মিনিট আগে</p>
    </div>
    <div class="notification-box">
        <span class="close-notify"></span>
        <h3>আপনি ১০ জিবি ডাটা পেয়েছেন!</h3>
        <p>৩২ মিনিট আগে</p>
    </div>
    <div class="notification-box">
        <span class="close-notify"></span>
        <h3>নতুন গল্প এসেছে। এখনই পড়ুন! 😃</h3>
        <p>৩২ মিনিট আগে</p>
    </div>
</div>

<footer class="footer">
    <ul>
        <li>
            <a href="javascript:void();" onclick="go_to_index('tab_home'); return false;" class="active">
                <img src="images/home.svg" alt="">হোম</a>
        </li>
        <li>
            <a href="javascript:void();" onclick="go_to_category('tab_category'); return false;">
                <img src="images/story-type.svg" alt="">গল্পের টাইপ </a>
        </li>
        <li>
            <a href="javascript:void();" onclick="go_to_favourite('tab_favourite'); return false;">
                <img src="images/heart.svg" alt="">
                আমার প্রিয়</a>
        </li>
        <li>
            <a href="javascript:void();" onclick="go_to_profile('tab_profile'); return false;">
                <img src="images/user.svg" alt="">প্রোফাইল </a>
        </li>
    </ul>
</footer>

<div class="modal age-modal" id="age-modal">
    <div class="modal-inner">
        <img src="images/18+.svg" alt="">
        <p>এই গল্পটি ১৮+ বয়সীদের জন্য। দয়া করে আপনার বয়স নিশ্চিত করুন।</p>
        <a class="btn-white" href="javascript:void();" onclick="hideModal('age-modal')">বাতিল</a>
        <a class="btn-common" href="">নিশ্চিত করুন</a>
    </div>
</div>

HTML;

        return ['code' => '900', 'data' => $htmlstr];
    }

    /**
     * Return the index page html.
     *
     * @param  int $id
     * @return String
     */
    public function index2($id)
    {
        return "Index Html";
    }
}