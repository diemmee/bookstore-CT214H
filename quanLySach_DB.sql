create database quanLySach character set='utf8';
drop database quanlysach;
show databases;
use quanLySach;
show tables;
SET SQL_SAFE_UPDATES=0;
SET FOREIGN_KEY_CHECKS=0;

create table admin (
	id_admin int not null,
    user_name varchar(50),
    passwd varchar(10)

);
create table nhaXuatBan(
	maNXB char(2) ,
    tenNXB varchar(50) not null,
    constraint PK_maNXB primary key(maNXB),
    constraint Ck_maNXB check(maNXB regexp '^[A-Z][A-Z]')
);

create table theLoai(
	maLoai char(2),
    tenLoai varchar(50) not null,
    constraint PK_maLoai primary key (maLoai),
    constraint ck_maloai CHECK (maloai regexp '^[A-Z][A-Z]')
);
select * from sach;
create table sach(
	maSach char(4),
	tenSach varchar(50) not null,
    maLoai char(6),
    tacGia varchar(50) not null,
    namXuatBan int not null,
    soLuong int not null,
    donGia int not null,
	maNXB char(6),
	constraint PK_maSach primary key(maSach),
	constraint FK_maLoai foreign key(maLoai) references theloai(maLoai),
	constraint FK_maNXB foreign key(maNXB) references nhaXuatBan(maNXB),
	constraint Ck_donGia check(donGia > 0)
);


 create table nhanVien(
	maNV char(6),
	tenNV varchar(50) not null,
	chucVu varchar(20) not null,
	gioiTinh char(3) not null, 
	sdt varchar(10) not null,
    luong int check (luong > 0),
	constraint PK_maNV primary key (maNV),
    constraint ck_maNV CHECK (maNV regexp '^[A-Z][A-Z][0-9]'),
	constraint Ck_GioiTinh check( gioiTinh in('Nam','Nữ')),
	constraint Ck_SDT check(sdt regexp '^0[1-9]')
 );

create table HoaDon(
	soHD char(6),
	maNV char(6),
    ngayLap date not null,
	constraint PK_soHD primary key(soHD),
    constraint fk_maNVHD foreign key(maNV) references nhanVien(maNV),
    CONSTRAINT fk02_HD FOREIGN KEY(MANV) REFERENCES NHANVIEN(MANV)
);

  CREATE TABLE CTHD(
	soHD	char(6),
	maSach	varchar(6),
	soLuongSach int not null,
    CONSTRAINT fk01_CTHD FOREIGN KEY(SOHD) REFERENCES HOADON(SOHD),
    CONSTRAINT fk02_CTHD FOREIGN KEY(maSach) REFERENCES Sach(maSach));
drop table cthd;
-----------------------------

-- 1 procedure them sach (THAN)
delimiter ?
create procedure them_sach(tmaSach char(4),ttenSach varchar(50), tmaLoai char(6), ttacgia varchar(50),tnamxuatban date,tsoLuong int, tdonGia int, tmaNXB char(6))
begin
		insert into sach  values (tmaSach, ttenSach, tmaLoai, ttacgia, tnamxuatban, tsoluong, tdonGia, tmaNXB);
end?

call them_sach('S011','Đời Như Cuộc Dời','TG','Nguyễn Minh Thân', 2019, 15, 19000, 'HD');

select *from sach;

-- 2 xóa sách (MY) 
create table sachDaXoa(
	maSach char(4),
	tenSach varchar(50),
	thoiGianXoa timestamp);

delimiter $
create trigger trig_sachDaXoa
	after delete on sach for each row
	begin
		insert into sachDaXoa values(old.maSach, old.tenSach, sysdate());
	end; $

delimiter $
CREATE PROCEDURE XOASACH (in masach1 CHAR(6))
BEGIN
	IF EXISTS (select masach from sach where masach = masach1)
    THEN  
    	DELETE FROM SACH WHERE MASACH = MASACH1;
	END IF;
END;  $

drop procedure xoasach;

call xoasach('S001');

delete from sach where maSach='S001';
select * from sach;
select * from sachDaXoa;

-- 3 thêm nhân viên (Thân)
delimiter ?
create procedure them_nhanvien(tmaNV char(6), ttenNV varchar(50), chucVu varchar(20),tgioitinh char(3),tsdt char(10),tluong int)
begin
	insert into nhanVien values (tmaNV,ttenNV,chucVu,tgioitinh,tsdt,tluong);
end?

call them_nhanvien('NV005','Nguyễn Minh Thân','Nhân viên quèn','Nam','0393853343','1000000');
select *from nhanvien;


-- 4 xoa nhân viên (THAN)
delimiter ?
create procedure xoa_nhanvien(XmaNV char(6))
begin
	delete  from nhanvien  where maNV = XmaNV;
end?

call xoa_nhanvien('NV005');
select *from nhanvien;

-- 5 update gia (MY)
create table capNhatGia(
	maSach char(4),
	tenSach varchar(50),
    giaCu int,
    giaMoi int,
	thoiGianCapNhat timestamp);
							
delimiter $
create trigger trig_capNhatGia
	after update on sach for each row
begin 
	insert into capNhatGia values(old.maSach, old.tenSach, old.donGia, new.donGia, sysdate());
end; $

update sach set donGia= donGia - 5000 where maSach='S002';

select * from capNhatGia;
select * from sach where maSach = 'S002';

-- 6 cap nhat so sach (THAN)
delimiter ?
select *from sach;
create function fn_sumSach()
returns int
begin
	return (select sum(soluong) from sach);
end?

select fn_sumSach();

create table thaydoi (
	maSach char(6),
    tenSach varchar(50),
    soluong int,
    newSL int);

set @tmasach='S002';
set @tsoluong=2;
drop trigger t_thaydoi?
delimiter ?
create trigger t_thaydoi
	after update on sach for each row
begin
		insert into thaydoi values (old.maSach, old.tenSach,old.soluong, new.soluong);
end?
update sach set soluong = soluong + @tsoluong where masach = @tmasach;

select * from thaydoi;
select * from sach;

-- 7 Số sách 01 nhân viên đã bán (MY)
delimiter $
create function soLuongSachDaBan (maNV char(6))
	returns int 
begin
	declare tongSachNVDaBan int;
	select sum(soLuongSach) into tongSachNVDaBan from CTHD ct join hoadon hd on ct.soHD=hd.soHD where hd.maNV = maNV;
	return tongSachNVDaBan;
end; $

select soLuongSachDaBan('NV001') from dual;
select * from cthd;

-- 8 Tổng tiền trong 1 hóa đơn nhiều loại sách (MY) 

create table banhang(
	soHD char(6),
    maNV char(6),
    masach char(6),
    soLuongSach int,
	dongia int);
	
drop procedure pr_banhang?
delimiter $
create procedure pr_banhang(p_sohd char(6))
begin
	insert into banhang select h.soHD, h.maNV, s.masach, t.soLuongsach, s.dongia 
				from hoadon h join cthd t on h.sohd = t.sohd
				join sach s on s.masach = t.masach	where h.sohd = p_sohd;
end$

call pr_banhang('HD001');
call pr_banhang('HD002');
call pr_banhang('HD003');
select *from banhang;

delimiter $
create function fn_banhang(f_sohd char(6))
returns int
begin
		return (select sum(soluongsach)*dongia as tongtien from banhang where sohd = f_sohd);
end $

select fn_banhang('HD001') from dual;


-- 9 update luong (MY)
create table updateLuongNV(
	maNV char(6),
    luongCu int,
    luongMoi int,
    thoiGianUpdate timestamp);
    
delimiter $
create trigger trig_updateLuongNV
	after update on nhanVien for each row
begin 
	insert into updateLuongNV values(old.maNV, old.luong, new.luong, now());
end; $

update nhanVien set luong=luong + 500000 where maNV='NV003';
select * from nhanvien;

-- 10 So hoa don nhan vien da ban (THAN)
delimiter ?
create procedure nvhd(mnv char(6))
begin
	select tennv, sohd from nhanvien n join hoadon h on n.manv = h.manv where n.manv = mnv;
end?
call nvhd('NV001');


--
select *from nhaxuatban;cthdmaSach
insert into nhaXuatBan values('HD', 'Nhà xuất bản Hồng Đức');
insert into nhaXuatBan values('KD', 'Nhà xuất bản Kim Đồng');
insert into nhaXuatBan values('QD', 'Nhà xuất bản Đại học Quốc Dân');
insert into nhaXuatBan values('TH', 'Nhà xuất bản Tổng Hợp');
insert into nhaXuatBan values('LD', 'Nhà xuất bản Lao Động');


select *from theLoai;
insert into theLoai values('TT', 'Sách Tiểu thuyết');
insert into theLoai values('KN', 'Sách Kỹ năng sống');
insert into theLoai values('YH', 'Sách y học');
insert into theLoai values('TG', 'Sách Tôn giáo - Tâm linh');
insert into theLoai values('KT', 'Sách Kinh tế');


select *from sach; 
insert into sach values('S001', 'Lập kế hoạch quản lý tài chính cá nhân', 'KT','Kristy Shen, Bryce Leung', 2019, 10, 130000, 'QD');
insert into sach values('S002', 'Nghệ thuân quản lý tài chính cá nhân', 'KT','Brian Tracy, Dan Strutzel', 2017, 10, 110000, 'LD');
insert into sach values('S003', 'Đường xưa mây trắng', 'TG','Thích Nhất Hạnh', 1987, 10, 250000, 'HD');
insert into sach values('S004', 'Hành trình về phương Đông', 'TG','Baird T. Spalding, Nguyên Phong', 2012, 10, 60000, 'HD');
insert into sach values('S005', 'Hiểu về trái tim', 'KN','Sư Minh Niệm', 2016, 20, 100000, 'TH');
insert into sach values('S006', 'Một cuốn sách về chủ nghĩa tối giản', 'KN','Chi Nguyễn – The Present Writer', 2022, 10, 130000, 'KD');
insert into sach values('S007', 'Suối nguồn', 'TT','Ayn Rand',1943, 10, 270000, 'LD');
insert into sach values('S008', 'Giết con chim nhại', 'TT',' Harper Lee', 1960, 10, 95000, 'TH');
insert into sach values('S009', 'Y Học Dinh Dưỡng - Những Điều Bác Sĩ Không Nói Với Bạn', 'YH','Bác sĩ D.Strand', 2019, 10, 110000, 'TH');
insert into sach values('S010', 'Nhân tố Enzyme - Phương Thức Sống Lành Mạnh', 'YH','Hiromi Shinya', 2007, 10, 70000, 'TH');

select *from nhanVien;
insert into nhanVien values ('NV001', 'Huỳnh Thiên Di', 'Quản lý', 'Nữ','0333155999', 10000000);
insert into nhanVien values ('NV004', 'Đinh Tuệ Minh', 'Nhân viên', 'Nữ', '0974555696', 8000000);
insert into nhanVien values ('NV003', 'Cao Minh Phúc', 'Nhân viên', 'Nam', '0378901001', 8000000);

select *from HoaDon;
insert into HoaDon values('HD001', 'NV001', now());
insert into HoaDon values('HD002', 'NV003', now());
insert into HoaDon values('HD003', 'NV004', now());
insert into HoaDon values('HD004', 'NV001', now());

insert into CTHD values ('HD001','S001',1);
insert into CTHD values ('HD001','S002',3);
insert into CTHD values ('HD001','S005',2);
insert into CTHD values ('HD002','S003',1);
insert into CTHD values ('HD002','S010',1);
insert into CTHD values ('HD003','S004',2);
insert into CTHD values ('HD003','S007',1);
insert into CTHD values ('HD004','S005',2);



