<?php
namespace App;
class Cart{
    //$newCart trong CartController.php
    public $dsNuocHoa = null; //Danh sách sản phẩm
    public $tongTien = 0; //Tổng tiền
    public $tongSoLuong = 0; //Tổng số lượng
    public $tongKhuyenMai = 0; //Tổng tiền khuyến mãi
    public $tongTienChinh = 0; //Tổng tiền khuyến mãi

    //Người dùng gọi tới một Cart cần có hàm dẫn
    //Hàm remove đi giỏ hàng
    //Người dùng tạo ra giỏ hàng, thì người ta truyền vào giỏ hàng hiện tại $cart
    public function __construct($cart){
        // Nếu $cart tồn tại, gán đối tượng $this   
        if($cart){
            $this->dsNuocHoa = $cart->dsNuocHoa;
            $this->tongTien = $cart->tongTien;
            $this->tongSoLuong = $cart->tongSoLuong;
            $this->tongKhuyenMai = $cart->tongKhuyenMai;
            $this->tongTienChinh = $cart->tongTienChinh;
            
        }
    }
    
    // Thêm sản phẩm vào giỏ hàng
    public function AddCart($nuocHoa, $id){
        $nuocHoaMoi = ['soLuong' => 0, 'giaTien' => $nuocHoa->gia_tien ,'tongTienChinh' => $nuocHoa->gia_tien, 'tongKhuyenMai' => 0,'giaKhuyenMai' => 0, 'thongTinNuocHoa' => $nuocHoa];
        // Nếu sản phẩm đã tồn tại
        if($this->dsNuocHoa){
            // Nếu tồn tại cái id trong cái product này
            if(array_key_exists($id, $this->dsNuocHoa)){
                $nuocHoaMoi = $this->dsNuocHoa[$id];
            }
        }
        $nuocHoaMoi['soLuong']++;
        $nuocHoaMoi['giaTien'] = $nuocHoaMoi['soLuong'] * (int)($nuocHoa->gia_tien - ($nuocHoa->gia_tien * ($nuocHoa->gia_khuyen_mai / 100)));
        $nuocHoaMoi['giaKhuyenMai'] = (int)($nuocHoa->gia_tien * ($nuocHoa->gia_khuyen_mai / 100));
        $nuocHoaMoi['tongTienChinh'] = (int)($nuocHoaMoi['soLuong'] * $nuocHoa->gia_tien);
        $nuocHoaMoi['tongKhuyenMai'] = (int)($nuocHoa->gia_tien * ($nuocHoa->gia_khuyen_mai / 100)) * $nuocHoaMoi['soLuong'];
        $this->dsNuocHoa[$id] = $nuocHoaMoi;
        $this->tongTien += (int)($nuocHoa->gia_tien - ($nuocHoa->gia_tien * ($nuocHoa->gia_khuyen_mai / 100)));
        $this->tongKhuyenMai += (int)($nuocHoa->gia_tien * ($nuocHoa->gia_khuyen_mai / 100));
        $this->tongTienChinh += (int)$nuocHoa->gia_tien;
        $this->tongSoLuong++;
    }

     // Xóa sản phẩm khỏi giỏ hàng
     public function DeleteItemCart($id){
        $this->tongSoLuong -= $this->dsNuocHoa[$id]['soLuong'];
        $this->tongTien -= $this->dsNuocHoa[$id]['giaTien'];
        $this->tongKhuyenMai -= $this->dsNuocHoa[$id]['tongKhuyenMai'];
        $this->tongTienChinh -= $this->dsNuocHoa[$id]['tongTienChinh'];
        // Xóa bỏ
        unset($this->dsNuocHoa[$id]);
    }

    // Cập nhật sản phẩm trong giỏ hàng
    public function UpdateItemCart($id, $so_luong){
        $this->tongSoLuong -= $this->dsNuocHoa[$id]['soLuong'];
        $this->tongTien -= $this->dsNuocHoa[$id]['giaTien'];
        $this->tongTienChinh -= $this->dsNuocHoa[$id]['tongTienChinh'];
        $this->tongKhuyenMai -= $this->dsNuocHoa[$id]['tongKhuyenMai'];
        
        $this->dsNuocHoa[$id]['soLuong'] = $so_luong;
        $this->dsNuocHoa[$id]['giaTien'] = $so_luong * (int)($this->dsNuocHoa[$id]['thongTinNuocHoa']->gia_tien - ($this->dsNuocHoa[$id]['thongTinNuocHoa']->gia_tien * ($this->dsNuocHoa[$id]['thongTinNuocHoa']->gia_khuyen_mai / 100)));
        $this->dsNuocHoa[$id]['tongTienChinh'] = $so_luong * (int)($this->dsNuocHoa[$id]['thongTinNuocHoa']->gia_tien);
        $this->dsNuocHoa[$id]['tongKhuyenMai'] = $so_luong * (int)($this->dsNuocHoa[$id]['thongTinNuocHoa']->gia_tien * ($this->dsNuocHoa[$id]['thongTinNuocHoa']->gia_khuyen_mai / 100));
        $this->dsNuocHoa[$id]['giaKhuyenMai'] = $this->dsNuocHoa[$id]['soLuong'] * ($this->dsNuocHoa[$id]['thongTinNuocHoa']->gia_tien * ($this->dsNuocHoa[$id]['thongTinNuocHoa']->gia_khuyen_mai / 100));

        $this->tongSoLuong += $this->dsNuocHoa[$id]['soLuong'];
        $this->tongTien += $this->dsNuocHoa[$id]['giaTien'];
        $this->tongTienChinh += $this->dsNuocHoa[$id]['tongTienChinh'];
        $this->tongKhuyenMai += $this->dsNuocHoa[$id]['tongKhuyenMai'];
    }
}
?> 