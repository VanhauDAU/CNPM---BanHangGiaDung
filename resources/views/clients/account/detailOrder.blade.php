@extends('layouts.client')

@section('title')
    Cập nhật thông tin
@endsection
@section('content-clients')
<div class="main-postss">
    <div class="container mt-1" style="padding: 70px 0px 0px; min-height: 100vh">
        <div class="d-flex align-items-center mb-3">
            <a href="{{route('home.index')}}" style="color:#1250DC">Trang chủ</a> <span class="mx-1">/</span>
            <a href="{{route('home.account.index')}}" style="color:#1250DC">Tài khoản</a> <span class="mx-1">/</span>
            <a href="{{route('home.account.myOrder')}}" style="color:#1250DC">Đơn hàng của tôi</a> <span class="mx-1">/</span>
            <a href="">Chi tiết đơn hàng</a>
        </div>
        <div class="d-grid">
            <div class="infoOrder">
                <div class="infoOrderUser bg-white"  style="border-radius: 13px">
                    <div class="header d-flex justify-content-between border-bottom pb-2" style="font-size: 13px">
                        <div class="order-id d-flex align-items-center">
                            <span class="fw-bold">{{ \Carbon\Carbon::parse($order->created_at)->format('d-m-Y') }}</span>
                            <i class="fa-solid fa-circle mx-1" style="color:#ddd; font-size: 5px"></i>
                            <span>#{{$order->id}}</span>
                            <i class="fa-solid fa-circle mx-1" style="color:#ddd; font-size: 5px"></i>
                            <span>{{count($order->OrderDetail)}} sản phẩm</span>
                        </div>
                        <div class="order-status">
                            <span class="status d-flex align-items-center">
                                @if($order->trang_thai ==0)
                                    <i class="fa-solid fa-circle me-2" style="color:#DA790A; font-size: 10px"></i>
                                    <h6 class="mb-0" style="color: #DA790A">Đang xử lý</h6>
                                @elseif($order->trang_thai ==1)
                                    <i class="fa-solid fa-truck me-2" style="color:#223240; font-size: 10px"></i>
                                    <h6 class="mb-0" style="color: #223240">Đang giao</h6>
                                @elseif($order->trang_thai ==2)
                                    <i class="fa-solid fa-circle me-2" style="color:#3B8C66; font-size: 10px"></i>
                                    <h6 class="mb-0" style="color: #3B8C66">Hoàn tất</h6>
                                @elseif($order->trang_thai ==3)
                                    <i class="fa-solid fa-ban me-2" style="color:#E02914; font-size: 10px"></i>
                                    <h6 class="mb-0" style="color: #E02914">Đã hủy</h6>
                                @else
                                    <i class="fa-solid fa-rotate me-2" style="color:#BD2A2E; font-size: 10px"></i>
                                    <h6 class="mb-0" style="color: #BD2A2E">Trả hàng</h6>
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="body d-flex align-items-center justify-content-center my-3 border-bottom py-3">
                        <div class="icon-item">
                            <div class="icon-item-svg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36" fill="none"><path d="M4.18555 9.59106C4.18555 10.4172 4.85791 11.0896 5.68518 11.0896H9.82922V32.625C9.85195 33.521 10.9096 34.0836 11.642 33.5149L14.2479 31.5011L16.8528 33.5149C17.2571 33.8291 17.8229 33.8291 18.2294 33.5149L20.8287 31.5022L23.427 33.5149C23.8335 33.8291 24.4004 33.8269 24.8047 33.5149L27.4019 31.5022L29.9968 33.5138C30.7271 34.0561 31.7892 33.5325 31.8107 32.625L31.814 6.15125C31.814 4.00012 30.0638 2.25 27.9127 2.25H27.827L8.13074 2.2511C8.12552 2.2511 8.12126 2.25398 8.11604 2.25405C8.10561 2.25398 8.09613 2.2511 8.08568 2.2511C5.93567 2.2511 4.18555 4.00122 4.18555 6.15125V9.59106ZM6.43555 6.15125C6.43555 5.24158 7.17603 4.5011 8.17578 4.5011C9.08545 4.5011 9.82593 5.24158 9.82593 6.15125V8.8396H6.43555V6.15125ZM26.713 29.1896L24.1158 31.2023L21.5176 29.1896C21.1111 28.8754 20.5464 28.8754 20.1399 29.1896L17.5405 31.2023L14.9357 29.1896C14.5314 28.8754 13.9645 28.8754 13.5602 29.1896L12.0792 30.3341V6.6698C12.0792 6.66396 12.076 6.65923 12.0759 6.65346V6.15125C12.0759 5.55908 11.9328 5.00331 11.6935 4.5H27.9127C28.0625 4.5 28.205 4.52644 28.343 4.564C29.0442 4.75461 29.564 5.3903 29.564 6.15125V7.37423L29.5607 7.36661V30.3302L28.0907 29.1907C27.6864 28.8765 27.1173 28.8776 26.713 29.1896Z" fill="#059669"></path><path d="M25.7518 24.2393H15.8916C15.2698 24.2393 14.7666 24.7424 14.7666 25.3643C14.7666 25.9861 15.2698 26.4893 15.8916 26.4893H25.7518C26.3737 26.4893 26.8768 25.9861 26.8768 25.3643C26.8768 24.7424 26.3737 24.2393 25.7518 24.2393Z" fill="#059669"></path><path d="M25.7518 20.4199H15.8916C15.2698 20.4199 14.7666 20.9231 14.7666 21.5449C14.7666 22.1667 15.2698 22.6699 15.8916 22.6699H25.7518C26.3737 22.6699 26.8768 22.1667 26.8768 21.5449C26.8768 20.9231 26.3737 20.4199 25.7518 20.4199Z" fill="#059669"></path><path d="M18.7898 15.8079C19.0007 16.0188 19.2864 16.1375 19.5852 16.1375C19.884 16.1375 20.1697 16.0188 20.3806 15.8079L26.1177 10.0708C26.5571 9.63135 26.5571 8.91943 26.1177 8.47998C25.6782 8.04053 24.9663 8.04053 24.5269 8.47998L19.5852 13.4216L17.1177 10.953C16.6782 10.5135 15.9663 10.5135 15.5269 10.953C15.0874 11.3925 15.0874 12.1044 15.5269 12.5438L18.7898 15.8079Z" fill="#059669"></path></svg>
                            </div>
                            <div class="icon-item-info text-center">
                                <span>Đặt hàng</span>
                            </div>
                        </div>
                        <div class="icon-item">
                            <div class="icon-item-svg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none"><path d="M29 2H21H11H3C2.44775 2 2 2.44727 2 3V29C2 29.5527 2.44775 30 3 30H29C29.5522 30 30 29.5527 30 29V3C30 2.44727 29.5522 2 29 2ZM28 28H4V4H10V15C10 15.3604 10.1938 15.6924 10.5073 15.8701C10.8208 16.0479 11.2051 16.042 11.5146 15.8574L16.0396 13.1895L20.4854 15.8574C20.6436 15.9521 20.8218 16 21 16C21.1699 16 21.3398 15.957 21.4927 15.8701C21.8062 15.6924 22 15.3604 22 15V4H28V28ZM20 13.2334L17.0674 11.4736C16.4087 11.0811 15.5908 11.0801 14.9312 11.4746L12 13.2334V4H20V13.2334Z" fill="#D97706"></path><path d="M10 15V4H12V13.2334L14.9312 11.4746C15.5908 11.0801 16.4087 11.0811 17.0674 11.4736L20 13.2334V4H22V15C22 15.3604 21.8062 15.6924 21.4927 15.8701C21.3398 15.957 21.1699 16 21 16C20.8218 16 20.6436 15.9521 20.4854 15.8574L16.0396 13.1895L11.5146 15.8574C11.2051 16.042 10.8208 16.0479 10.5073 15.8701C10.1938 15.6924 10 15.3604 10 15Z" fill="#D97706"></path></svg>    
                            </div>
                            <div class="icon-item-info text-center">
                                <span>Đang xử lý</span>
                            </div>
                        </div>
                        <div class="icon-item">
                            <div class="icon-item-svg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none"><path d="M25.1363 30.2283C25.1137 30.4115 25.1029 30.5773 25.1029 30.7449L25.1029 30.7468L25.1689 36.0019C25.1764 36.6097 24.6907 37.1079 24.0838 37.1159H24.0688C23.4672 37.1159 22.9764 36.6324 22.9688 36.0299L22.8188 36.0317L22.9688 36.0299L22.9029 30.7607C22.9029 30.7604 22.9029 30.7601 22.9029 30.7598C22.903 30.4867 22.9191 30.2308 22.9512 29.975L22.9512 29.975L22.9515 29.9725C23.0433 29.1298 23.3056 28.2865 23.7303 27.4835L27.2527 21.0611L27.2527 21.0612L27.2536 21.0596C27.9125 19.823 29.4878 19.2548 30.8477 19.7772L31.0857 19.8686L31.05 19.6162L30.4082 15.0733L30.4064 15.0608L30.4026 15.0489C30.2189 14.4701 30.2592 13.847 30.5216 13.2771C30.8324 12.6025 31.4332 12.065 32.1727 11.8065C32.5568 11.6861 32.8558 11.6383 33.1582 11.6383C34.3083 11.6383 35.3296 12.3172 35.7063 13.3133C35.7264 13.3677 35.7426 13.4228 35.7544 13.4775C35.7544 13.4777 35.7545 13.4778 35.7545 13.4779L37.1874 20.3325L37.1895 20.3423L37.1928 20.3518C37.4604 21.1077 37.384 21.9529 36.973 22.6923L36.9723 22.6935L33.2659 29.5118C33.1888 29.6525 33.1027 29.8831 33.2073 30.1317L34.1862 32.4738C34.4204 33.0346 34.1555 33.6792 33.5953 33.9134L33.5953 33.9134C33.4569 33.9713 33.3131 33.9982 33.1716 33.9982C32.7404 33.9982 32.3325 33.7444 32.1558 33.3225L31.1787 30.9837L31.1785 30.9831C30.8389 30.179 30.8943 29.2567 31.3364 28.4553L31.3369 28.4544L35.0449 21.6327C35.045 21.6326 35.0451 21.6324 35.0452 21.6323C35.1162 21.5033 35.2022 21.2894 35.1112 21.0646L35.1109 21.0639C35.0864 21.0042 35.0671 20.941 35.0537 20.8777C35.0537 20.8776 35.0536 20.8775 35.0536 20.8774L33.6322 14.0772L33.624 14.0379L33.5972 14.008C33.5127 13.9134 33.3494 13.8383 33.1582 13.8383C33.0963 13.8383 33.0147 13.8483 32.8641 13.8951L32.8641 13.895L32.8588 13.8968C32.6968 13.9538 32.571 14.0862 32.5196 14.1978L32.4929 14.2558L32.5162 14.3152C32.5268 14.3421 32.5372 14.3928 32.5467 14.4609C32.5512 14.4928 32.555 14.5253 32.5587 14.5569L32.5598 14.5659C32.563 14.5937 32.5663 14.6214 32.5696 14.645L32.5696 14.6452L33.2526 19.4805L33.2544 19.4931L33.2583 19.5053C33.5018 20.2648 33.4186 21.0959 33.0229 21.8072L33.0227 21.8074C32.532 22.6933 30.9133 25.6702 30.0902 27.1841C29.9588 27.4257 29.8477 27.6299 29.7647 27.7826L29.7646 27.7828C29.4749 28.3172 28.8082 28.5133 28.2725 28.2242C27.739 27.9328 27.5418 27.2646 27.8321 26.7322L27.8322 26.7321L30.2761 22.2399L30.2878 22.2183L30.292 22.1941C30.3096 22.0941 30.2837 22.007 30.2282 21.9408C30.1784 21.8816 30.1135 21.8494 30.0675 21.8312M25.1363 30.2283C25.1363 30.2279 25.1364 30.2276 25.1364 30.2273L25.2853 30.2456M25.1363 30.2283C25.1362 30.2286 25.1362 30.229 25.1362 30.2293L25.2853 30.2456M25.1363 30.2283C25.2002 29.6436 25.3819 29.0655 25.6666 28.5275L25.6677 28.5255L25.6677 28.5255L29.1876 22.1082C29.1877 22.108 29.1878 22.1078 29.1879 22.1075C29.2606 21.9728 29.4064 21.8755 29.5568 21.8254C29.7106 21.7742 29.8968 21.7627 30.0675 21.8312M25.2853 30.2456C25.3469 29.6804 25.5227 29.1201 25.7992 28.5977L24.0847 37.2659C24.775 37.2573 25.3274 36.6909 25.3188 36L25.2529 30.7449C25.2529 30.5837 25.2633 30.4238 25.2853 30.2456ZM30.0675 21.8312C30.0674 21.8311 30.0673 21.8311 30.0672 21.831L30.0118 21.9705L30.0678 21.8313C30.0677 21.8312 30.0676 21.8312 30.0675 21.8312Z" fill="#090D14" stroke="white" stroke-width="0.3"></path><path d="M17.0511 29.9932L17.0508 29.9909C16.9566 29.1298 16.6942 28.2865 16.261 27.4676L12.7532 21.0721L12.7524 21.0707L12.7524 21.0707C12.0882 19.827 10.5128 19.2643 9.15125 19.7777L8.91439 19.867L8.9498 19.6163L9.59166 15.0733L9.59342 15.0608L9.59722 15.0489C9.78094 14.4701 9.74068 13.847 9.47822 13.2771C9.16789 12.6035 8.56772 12.0654 7.7877 11.7931C7.44387 11.6864 7.1447 11.6383 6.84163 11.6383C5.69154 11.6383 4.67017 12.3172 4.29353 13.3133C4.27343 13.3677 4.25725 13.4228 4.24544 13.4775C4.2454 13.4776 4.24537 13.4778 4.24534 13.4779L2.81243 20.3325L2.81037 20.3423L2.80701 20.3518C2.53933 21.108 2.61599 21.9532 3.02127 22.6812L3.02201 22.6825L3.022 22.6825L6.73738 29.5189C6.73747 29.519 6.73755 29.5192 6.73764 29.5193C6.81217 29.6546 6.89658 29.8845 6.79068 30.1353C6.79065 30.1354 6.79062 30.1355 6.79059 30.1355L5.81366 32.4738C5.57946 33.0346 5.84431 33.6792 6.40449 33.9134C6.54367 33.9714 6.68691 33.9982 6.8282 33.9982C7.25881 33.9982 7.66733 33.7444 7.84396 33.3226L17.0511 29.9932ZM17.0511 29.9932C17.0808 30.2307 17.0969 30.4866 17.0969 30.7439C17.0969 30.7442 17.0969 30.7446 17.0969 30.7449L17.031 36.0299C17.0235 36.6324 16.5326 37.1159 15.931 37.1159H15.9161C15.3091 37.1079 14.8235 36.6097 14.831 36.0019L14.8969 30.7309V30.729C14.8969 30.5772 14.8861 30.4116 14.866 30.2466M17.0511 29.9932L7.84401 33.3225L8.8193 30.9874L8.81955 30.9868C9.16106 30.1787 9.10534 29.2565 8.6671 28.4626L8.66662 28.4618L4.94971 21.6223C4.94959 21.6221 4.94946 21.6218 4.94934 21.6216C4.88263 21.5016 4.79809 21.2883 4.88861 21.0646L4.88891 21.0639C4.91339 21.0043 4.93272 20.941 4.94617 20.8776C4.94619 20.8775 4.94621 20.8774 4.94623 20.8773L6.36765 14.0772L6.37587 14.0379L6.40263 14.008C6.48715 13.9134 6.65044 13.8383 6.84163 13.8383C6.89992 13.8383 6.98036 13.847 7.09461 13.8812L7.101 13.8831L7.10095 13.8833C7.20008 13.9178 7.28615 13.9692 7.35531 14.0424C7.42447 14.1156 7.47049 14.2039 7.49908 14.3032L7.51312 14.352L7.49466 14.3993C7.46399 14.4779 7.44202 14.5605 7.43026 14.645L7.43022 14.6452L6.74723 19.4805L6.74545 19.4931L6.74155 19.5053C6.49796 20.265 6.58072 21.0949 6.97273 21.7999L6.97282 21.8001C7.4775 22.7104 9.28559 26.0361 10.0457 27.4341C10.1194 27.5697 10.1833 27.6872 10.2351 27.7826L10.2352 27.7828C10.525 28.3172 11.1917 28.5133 11.7273 28.2241C12.2608 27.9327 12.458 27.2646 12.1677 26.7322L12.1675 26.7319L9.70355 22.1897L9.6854 22.1562V22.1182C9.6854 22.0229 9.74232 21.9557 9.78427 21.9187C9.82903 21.8792 9.88227 21.8509 9.92759 21.8326L9.92922 21.8319L9.92923 21.8319C10.1013 21.7649 10.2883 21.7754 10.4444 21.828C10.5974 21.8795 10.7437 21.9795 10.8182 22.1188C10.8183 22.1191 10.8185 22.1194 10.8187 22.1198L14.3236 28.5096L14.3247 28.5116L14.3247 28.5116C14.618 29.0655 14.7997 29.6437 14.866 30.2466M14.866 30.2466C14.866 30.2463 14.8659 30.246 14.8659 30.2457L14.717 30.2639L14.8661 30.2475C14.8661 30.2472 14.866 30.2469 14.866 30.2466Z" fill="#090D14" stroke="white" stroke-width="0.3"></path><path d="M19.375 5.08437H19.225V5.23438V7.02637V7.17637H19.375H20.625H20.775V7.02637V5.23438V5.08437H20.625H19.375ZM14.375 5.08437H14.225V5.23438V16.4844V16.6344H14.375H25.625H25.775V16.4844V5.23438V5.08437H25.625H23.125H22.975V5.23438V8.27637C22.975 8.88439 22.4825 9.37637 21.875 9.37637H18.125C17.5175 9.37637 17.025 8.88439 17.025 8.27637V5.23438V5.08437H16.875H14.375ZM27.975 3.98438V17.7344C27.975 18.3424 27.4825 18.8344 26.875 18.8344H13.125C12.5175 18.8344 12.025 18.3424 12.025 17.7344V3.98438C12.025 3.37635 12.5175 2.88438 13.125 2.88438H18.125H21.875H26.875C27.4825 2.88438 27.975 3.37635 27.975 3.98438Z" fill="#090D14" stroke="white" stroke-width="0.3"></path></svg>
                            </div>
                            <div class="icon-item-info text-center">
                                <span>Đang giao</span>
                            </div>
                        </div>
                        <div class="icon-item">
                            <div class="icon-item-svg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none"><path d="M25.1363 30.2283C25.1137 30.4115 25.1029 30.5773 25.1029 30.7449L25.1029 30.7468L25.1689 36.0019C25.1764 36.6097 24.6907 37.1079 24.0838 37.1159H24.0688C23.4672 37.1159 22.9764 36.6324 22.9688 36.0299L22.8188 36.0317L22.9688 36.0299L22.9029 30.7607C22.9029 30.7604 22.9029 30.7601 22.9029 30.7598C22.903 30.4867 22.9191 30.2308 22.9512 29.975L22.9512 29.975L22.9515 29.9725C23.0433 29.1298 23.3056 28.2865 23.7303 27.4835L27.2527 21.0611L27.2527 21.0612L27.2536 21.0596C27.9125 19.823 29.4878 19.2548 30.8477 19.7772L31.0857 19.8686L31.05 19.6162L30.4082 15.0733L30.4064 15.0608L30.4026 15.0489C30.2189 14.4701 30.2592 13.847 30.5216 13.2771C30.8324 12.6025 31.4332 12.065 32.1727 11.8065C32.5568 11.6861 32.8558 11.6383 33.1582 11.6383C34.3083 11.6383 35.3296 12.3172 35.7063 13.3133C35.7264 13.3677 35.7426 13.4228 35.7544 13.4775C35.7544 13.4777 35.7545 13.4778 35.7545 13.4779L37.1874 20.3325L37.1895 20.3423L37.1928 20.3518C37.4604 21.1077 37.384 21.9529 36.973 22.6923L36.9723 22.6935L33.2659 29.5118C33.1888 29.6525 33.1027 29.8831 33.2073 30.1317L34.1862 32.4738C34.4204 33.0346 34.1555 33.6792 33.5953 33.9134L33.5953 33.9134C33.4569 33.9713 33.3131 33.9982 33.1716 33.9982C32.7404 33.9982 32.3325 33.7444 32.1558 33.3225L31.1787 30.9837L31.1785 30.9831C30.8389 30.179 30.8943 29.2567 31.3364 28.4553L31.3369 28.4544L35.0449 21.6327C35.045 21.6326 35.0451 21.6324 35.0452 21.6323C35.1162 21.5033 35.2022 21.2894 35.1112 21.0646L35.1109 21.0639C35.0864 21.0042 35.0671 20.941 35.0537 20.8777C35.0537 20.8776 35.0536 20.8775 35.0536 20.8774L33.6322 14.0772L33.624 14.0379L33.5972 14.008C33.5127 13.9134 33.3494 13.8383 33.1582 13.8383C33.0963 13.8383 33.0147 13.8483 32.8641 13.8951L32.8641 13.895L32.8588 13.8968C32.6968 13.9538 32.571 14.0862 32.5196 14.1978L32.4929 14.2558L32.5162 14.3152C32.5268 14.3421 32.5372 14.3928 32.5467 14.4609C32.5512 14.4928 32.555 14.5253 32.5587 14.5569L32.5598 14.5659C32.563 14.5937 32.5663 14.6214 32.5696 14.645L32.5696 14.6452L33.2526 19.4805L33.2544 19.4931L33.2583 19.5053C33.5018 20.2648 33.4186 21.0959 33.0229 21.8072L33.0227 21.8074C32.532 22.6933 30.9133 25.6702 30.0902 27.1841C29.9588 27.4257 29.8477 27.6299 29.7647 27.7826L29.7646 27.7828C29.4749 28.3172 28.8082 28.5133 28.2725 28.2242C27.739 27.9328 27.5418 27.2646 27.8321 26.7322L27.8322 26.7321L30.2761 22.2399L30.2878 22.2183L30.292 22.1941C30.3096 22.0941 30.2837 22.007 30.2282 21.9408C30.1784 21.8816 30.1135 21.8494 30.0675 21.8312M25.1363 30.2283C25.1363 30.2279 25.1364 30.2276 25.1364 30.2273L25.2853 30.2456M25.1363 30.2283C25.1362 30.2286 25.1362 30.229 25.1362 30.2293L25.2853 30.2456M25.1363 30.2283C25.2002 29.6436 25.3819 29.0655 25.6666 28.5275L25.6677 28.5255L25.6677 28.5255L29.1876 22.1082C29.1877 22.108 29.1878 22.1078 29.1879 22.1075C29.2606 21.9728 29.4064 21.8755 29.5568 21.8254C29.7106 21.7742 29.8968 21.7627 30.0675 21.8312M25.2853 30.2456C25.3469 29.6804 25.5227 29.1201 25.7992 28.5977L24.0847 37.2659C24.775 37.2573 25.3274 36.6909 25.3188 36L25.2529 30.7449C25.2529 30.5837 25.2633 30.4238 25.2853 30.2456ZM30.0675 21.8312C30.0674 21.8311 30.0673 21.8311 30.0672 21.831L30.0118 21.9705L30.0678 21.8313C30.0677 21.8312 30.0676 21.8312 30.0675 21.8312Z" fill="#090D14" stroke="white" stroke-width="0.3"></path><path d="M17.0511 29.9932L17.0508 29.9909C16.9566 29.1298 16.6942 28.2865 16.261 27.4676L12.7532 21.0721L12.7524 21.0707L12.7524 21.0707C12.0882 19.827 10.5128 19.2643 9.15125 19.7777L8.91439 19.867L8.9498 19.6163L9.59166 15.0733L9.59342 15.0608L9.59722 15.0489C9.78094 14.4701 9.74068 13.847 9.47822 13.2771C9.16789 12.6035 8.56772 12.0654 7.7877 11.7931C7.44387 11.6864 7.1447 11.6383 6.84163 11.6383C5.69154 11.6383 4.67017 12.3172 4.29353 13.3133C4.27343 13.3677 4.25725 13.4228 4.24544 13.4775C4.2454 13.4776 4.24537 13.4778 4.24534 13.4779L2.81243 20.3325L2.81037 20.3423L2.80701 20.3518C2.53933 21.108 2.61599 21.9532 3.02127 22.6812L3.02201 22.6825L3.022 22.6825L6.73738 29.5189C6.73747 29.519 6.73755 29.5192 6.73764 29.5193C6.81217 29.6546 6.89658 29.8845 6.79068 30.1353C6.79065 30.1354 6.79062 30.1355 6.79059 30.1355L5.81366 32.4738C5.57946 33.0346 5.84431 33.6792 6.40449 33.9134C6.54367 33.9714 6.68691 33.9982 6.8282 33.9982C7.25881 33.9982 7.66733 33.7444 7.84396 33.3226L17.0511 29.9932ZM17.0511 29.9932C17.0808 30.2307 17.0969 30.4866 17.0969 30.7439C17.0969 30.7442 17.0969 30.7446 17.0969 30.7449L17.031 36.0299C17.0235 36.6324 16.5326 37.1159 15.931 37.1159H15.9161C15.3091 37.1079 14.8235 36.6097 14.831 36.0019L14.8969 30.7309V30.729C14.8969 30.5772 14.8861 30.4116 14.866 30.2466M17.0511 29.9932L7.84401 33.3225L8.8193 30.9874L8.81955 30.9868C9.16106 30.1787 9.10534 29.2565 8.6671 28.4626L8.66662 28.4618L4.94971 21.6223C4.94959 21.6221 4.94946 21.6218 4.94934 21.6216C4.88263 21.5016 4.79809 21.2883 4.88861 21.0646L4.88891 21.0639C4.91339 21.0043 4.93272 20.941 4.94617 20.8776C4.94619 20.8775 4.94621 20.8774 4.94623 20.8773L6.36765 14.0772L6.37587 14.0379L6.40263 14.008C6.48715 13.9134 6.65044 13.8383 6.84163 13.8383C6.89992 13.8383 6.98036 13.847 7.09461 13.8812L7.101 13.8831L7.10095 13.8833C7.20008 13.9178 7.28615 13.9692 7.35531 14.0424C7.42447 14.1156 7.47049 14.2039 7.49908 14.3032L7.51312 14.352L7.49466 14.3993C7.46399 14.4779 7.44202 14.5605 7.43026 14.645L7.43022 14.6452L6.74723 19.4805L6.74545 19.4931L6.74155 19.5053C6.49796 20.265 6.58072 21.0949 6.97273 21.7999L6.97282 21.8001C7.4775 22.7104 9.28559 26.0361 10.0457 27.4341C10.1194 27.5697 10.1833 27.6872 10.2351 27.7826L10.2352 27.7828C10.525 28.3172 11.1917 28.5133 11.7273 28.2241C12.2608 27.9327 12.458 27.2646 12.1677 26.7322L12.1675 26.7319L9.70355 22.1897L9.6854 22.1562V22.1182C9.6854 22.0229 9.74232 21.9557 9.78427 21.9187C9.82903 21.8792 9.88227 21.8509 9.92759 21.8326L9.92922 21.8319L9.92923 21.8319C10.1013 21.7649 10.2883 21.7754 10.4444 21.828C10.5974 21.8795 10.7437 21.9795 10.8182 22.1188C10.8183 22.1191 10.8185 22.1194 10.8187 22.1198L14.3236 28.5096L14.3247 28.5116L14.3247 28.5116C14.618 29.0655 14.7997 29.6437 14.866 30.2466M14.866 30.2466C14.866 30.2463 14.8659 30.246 14.8659 30.2457L14.717 30.2639L14.8661 30.2475C14.8661 30.2472 14.866 30.2469 14.866 30.2466Z" fill="#090D14" stroke="white" stroke-width="0.3"></path><path d="M19.375 5.08437H19.225V5.23438V7.02637V7.17637H19.375H20.625H20.775V7.02637V5.23438V5.08437H20.625H19.375ZM14.375 5.08437H14.225V5.23438V16.4844V16.6344H14.375H25.625H25.775V16.4844V5.23438V5.08437H25.625H23.125H22.975V5.23438V8.27637C22.975 8.88439 22.4825 9.37637 21.875 9.37637H18.125C17.5175 9.37637 17.025 8.88439 17.025 8.27637V5.23438V5.08437H16.875H14.375ZM27.975 3.98438V17.7344C27.975 18.3424 27.4825 18.8344 26.875 18.8344H13.125C12.5175 18.8344 12.025 18.3424 12.025 17.7344V3.98438C12.025 3.37635 12.5175 2.88438 13.125 2.88438H18.125H21.875H26.875C27.4825 2.88438 27.975 3.37635 27.975 3.98438Z" fill="#090D14" stroke="white" stroke-width="0.3"></path></svg>
                            </div>
                            <div class="icon-item-info text-center">
                                <span>Hoàn tất</span>
                            </div>
                        </div>
                    </div>
                    <div class="bottom">
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <h6 class="fw-bold">Thông tin nhận hàng</h6>
                                <span>
                                    {{ strtoupper($order->User->ho_ten)  }}
                                </span> <br>
                                <span>{{ $order->User->so_dien_thoai }}</span>
                            </div>
                            <div class="col-md-6 border-start">
                                <h6 class="fw-bold">Địa chỉ nhận hàng</h6>
                                <p>{{$order->dia_chi}}, {{$order->Wards->name}}, {{$order->District->name}}, {{ $order->Province->name }}, Việt Nam</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="infoOrderProduct bg-white mt-3"  style="border-radius: 13px">
                    <h6 class="fw-bold">Danh sách sản phẩm</h6>
                    @foreach($order->OrderDetail as $orderProduct)
                    <div class="order-products d-flex justify-content-between mb-4">
                        <div class="product-info d-flex">
                            <div class="product-img border rounded me-2" style="min-width: 60px; max-height: 60px">
                                <img width="60" src="{{asset('storage/products/img/'.$orderProduct->Product->anh)}}" alt="">
                            </div>
                            <div class="product-name">
                                <h6>{{$orderProduct->Product->ten_san_pham}}</h6>
                                <span style="font-size: 15px; color:#999">Số lượng: {{$orderProduct->so_luong}}</span>
                            </div>
                        </div>
                        <div class="product-price">
                            <span class="fw-bold">{{number_format($orderProduct->gia,0,',','.')}}đ</span>
                        </div>
                    </div>
                    @endforeach
                    
                </div>
            </div>
            <div class="infoPay bg-white" style="border-radius: 13px">
                <h6 class="fw-bold">Thông tin thanh toán</h6>
            </div>
        </div>
    </div>
</div>
@endsection

@section('stylesheetAccount')
<style>
    .main-postss{
        background-color: #F3F4F6;
        width: 100%;
    }
    .d-grid {
        display: grid;
        grid-template-columns: 6.5fr 3.5fr;
        gap: 16px;
    }
    .infoOrderUser,.infoOrderProduct, .infoPay {
        padding: 16px;
        background-color: #f0f0f0;
    }
    .infoOrderUser .body{
        gap: 40px;
    }
    .infoOrderUser .body .icon-item .icon-item-svg{
        border: black 3px solid;
        border-radius: 50%;
        padding: 17px;

    }
    .infoOrder .body .icon-item svg {
        width: 50px;
        height: 50px;
        fill: #059669;
    }
    .icon-item-info span {
        display: block;
        font-size: 14px;
        margin-top: 5px;
    }
</style>
@endsection