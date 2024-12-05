<?php defined('BASEPATH') or exit('No direct script access allowed');
class Admin_model extends CI_Model
{
    public function loadListProduct($length, $start, $search, $orderColumn, $orderSort)
    {
        $orderArr = [
            'product_name',
            'uom',
            'size',
            'color',
            'price',
            'category',
            'description'
        ];
        $orderBy = $orderArr[$orderColumn];
        $query = "          SELECT
                            a.* ,
                            product_image.cover
                            FROM
                            (
                            SELECT
                            DISTINCT
                            varian.id,
                            varian.id_product,
                            product.image,
                            product.product_name,
                            master_uom.id id_uom,
                            master_uom.uom,
                            product.description,
                            GROUP_CONCAT(DISTINCT master_category.category) category,
                            varian.image image_varian,
                            master_color.id id_color,
                            master_color.color,
                            master_size.id id_size,
                            master_size.size,
                            varian.price,
                            varian.stock
                            FROM
                            varian
                            LEFT JOIN
                            product
                            ON
                            product.id_product = varian.id_product
                            LEFT JOIN
                            master_color
                            ON
                            master_color.id = varian.id_color
                            LEFT JOIN
                            master_size
                            ON 
                            master_size.id = varian.id_size
                            LEFT JOIN
                            access_category
                            ON
                            access_category.id_product = product.id_product
                            LEFT JOIN
                            master_category
                            ON
                            master_category.id = access_category.id_category
                            LEFT JOIN
                            master_uom
                            ON
                            master_uom.id = product.uom
                            GROUP BY
                            varian.id
                            ) a
                            LEFT JOIN
                            product_image ON product_image.id_product = a.id_product
                            WHERE
                            product_image.cover IS NOT NULL
                            GROUP BY
                            a.id_product";
        $query .= "							
                                        ORDER BY
								" . $orderBy . " " . $orderSort . " 
									";



        if ($length != '' && $start != '') {
            $query .= " limit $length
                                OFFSET $start";
        }
        // var_dump($query);
        // die;
        $res = $this->db->query($query);
        return $res;
    }
    public function loadListProductVarian($id_product, $length, $start, $search, $orderColumn, $orderSort)
    {
        $orderArr = [
            'product_name',
            'uom',
            'size',
            'color',
            'price',
            'category',
            'description'
        ];
        $orderBy = $orderArr[$orderColumn];
        $query = $this->queryAllData();
        $query .= "						
                                WHERE id_product = '" . $id_product . "'
                                ORDER BY
								" . $orderBy . " " . $orderSort . " 
									";



        if ($length != '' && $start != '') {
            $query .= " limit $length
                                OFFSET $start";
        }
        // var_dump($query);
        // die;
        $res = $this->db->query($query);
        return $res;
    }

    public  function queryAllData()
    {
        $query = "          SELECT
                            * 
                            FROM
                            (
                            SELECT
                            DISTINCT
                            varian.id,
                            varian.id_product,
                            product.image,
                            product.product_name,
                            master_uom.id id_uom,
                            master_uom.uom,
                            product.description,
                            GROUP_CONCAT(DISTINCT master_category.category) category,
                            varian.image image_varian,
                            master_color.id id_color,
                            master_color.color,
                            master_size.id id_size,
                            master_size.size,
                            varian.price,
                            varian.price_diskon,
                            varian.keterangan,
                            varian.stock
                            FROM
                            varian
                            LEFT JOIN
                            product
                            ON
                            product.id_product = varian.id_product
                            LEFT JOIN
                            master_color
                            ON
                            master_color.id = varian.id_color
                            LEFT JOIN
                            master_size
                            ON 
                            master_size.id = varian.id_size
                            LEFT JOIN
                            access_category
                            ON
                            access_category.id_product = product.id_product
                            LEFT JOIN
                            master_category
                            ON
                            master_category.id = access_category.id_category
                            LEFT JOIN
                            master_uom
                            ON
                            master_uom.id = product.uom
                            WHERE
                            product_name IS NOT NULL
                            GROUP BY
                            varian.id
                            ) a";
        return $query;
    }

    public function updateProduct($id)
    {
        $id_product = $this->db->get_where('varian', ['id' => $id])->row_array();
        $id_product = $id_product['id_product'];
        $query = $this->queryAllData();
        $query .= "
        WHERE id_product = '" . $id_product . "'
        ";
        $res = $this->db->query($query);
        return $res->row_array();
    }
    public function updateProductDetail($id)
    {
        $id_product =
            $query = $this->queryAllData();
        $query .= "
        WHERE id = '" . $id . "'
        ";
        $res = $this->db->query($query);
        return $res->row_array();
    }


    public function slide1($category)
    {
        $query = $this->queryAllData();
        $query .= " where category like '%" . $category . "%' GROUP BY id_product";
        $res = $this->db->query($query);
        return $res->result_array();
    }
    public function shop()
    {
        $query = $this->queryAllData();
        $query .= " where price_diskon <> 0 GROUP BY id_product";
        $res = $this->db->query($query);
        return $res->result_array();
    }
    public function detail_product($id)
    {
        $getID = $this->db->get_where('varian', ['id' => $id])->row_array();
        $getID = $getID['id_product'];
        $query = $this->queryAllData();
        $query .= " where id_product = '" . $getID . "' ";
        $res = $this->db->query($query);
        return $res->result_array();
    }

    public function cart($id_user)
    {
        $query = "  SELECT
                    varian.id,
                    product.id_product,
                    product.product_name,
                    SUM(qty) qty,
                    price_diskon price, 
                    product.image,
                    varian.image image_varian,
                    master_color.color,
                    varian.id_color,
                    varian.id_size,
                    master_size.size
                    FROM
                    cart
                    LEFT JOIN varian ON varian.id = cart.id_varian
                    LEFT JOIN product ON product.id_product = varian.id_product
                    LEFT JOIN master_color ON master_color.id = varian.id_color
                    LEFT JOIN master_size ON master_size.id = varian.id_size
                    where
                    cart.id_user = '" . $id_user . "'
                    AND (invoice IS NULL OR invoice = '')
                    AND product.id_product IS NOT NULL
                    GROUP BY
                    varian.id_product,
                    master_color.color,
                    cart.id_size,
                    cart.id_color
";
        $res = $this->db->query($query);
        return $res->result_array();
    }
    public function cartCheckout($id_user)
    {
        $query = "  SELECT
                    product.id,
                    product.product_name,
                    SUM(cart.qty) qty,
                    varian.price_diskon price, 
                    product.image,
                    varian.image image_varian,
                    master_color.color,
                    master_size.size
                    FROM
                    cart
                    LEFT JOIN varian  ON varian.id = cart.id_varian
                    LEFT JOIN product ON product.id_product = varian.id_product
                    LEFT JOIN master_color ON master_color.id = varian.id_color
                    LEFT JOIN master_size ON master_size.id = varian.id_size

                    where
                    cart.id_user = '" . $id_user . "'
                    AND selected = 1
                    AND invoice is null 
                    GROUP BY
                    varian.id";
        $res = $this->db->query($query);
        return $res->result_array();
    }

    public function loadTotalSelected($id_user)
    {
        $query = "  SELECT
                        id_user,
                        SUM( qty ) qty,
                        SUM( total ) total
                    FROM
                        (
                        SELECT
                            id_user,
                            id_product,
                            qty,
                            price_diskon,
                            qty * price_diskon total 
                        FROM
                            cart
                            LEFT JOIN varian ON varian.id = cart.id_varian 
                        WHERE
                            selected = 1
                            AND 
                            id_user = " . $id_user . " 
                            AND (invoice = '' OR invoice IS NULL)
                        ) a 
                    GROUP BY
                        id_user";
        $res = $this->db->query($query);
        return $res->row_array();
    }

    public function
    makeOrder($kurir, $kurirService,    $kurirDesc,    $kurirEtd, $kurirPrice, $id_user)
    {
        $user = $this->db->get_where('auth_user', ['id' => $id_user])->row_array();
        $inv = substr($user['firstName'], 0, 3) . "-" . date('Ymd') . "-" . time();
        $product = $this->db->get_where('cart', ['id_user' => $id_user, 'selected' => 1, 'invoice' => null])->result_array();
        // var_dump($product);
        // die;
        $dataInv = [];
        $this->db->update(
            'cart',
            ['invoice' => $inv, 'date_modified' => date('Y-m-d H:i:sa')],
            ['id_user' => $user['id'], 'selected' => 1, 'invoice' => null]
        );

        $this->session->set_userdata('invoice', $inv);

        foreach ($product as $p) {
            array_push($dataInv, [
                'invoice' => $inv,
                'id_cart' => $p['id'],
                'kurir' => $kurir,
                'kurir_service' => $kurirService,
                'kurir_desc' => $kurirDesc,
                'kurir_etd' => $kurirEtd,
                'kurir_price' => str_replace(".", "", $kurirPrice),
                'date_created' => date('Y-m-d H:i:sa')
            ]);
        }
        $result = $this->db->insert_batch('invoice', $dataInv);
        if ($result) {
            return $this->dataSales($id_user, $inv);
        }
    }

    public function dataSales($id_user, $invoice)
    {
        $query =    "   SELECT
                        auth_user.firstName,
                        auth_user.telp,
                        auth_user.email,
                        a.jumlah + invoice.kurir_price total,
                        a.qty,
                        a.invoice
                        FROM
                        (
                        SELECT
                        id_user,
                        SUM(varian.price_diskon * qty) jumlah,
                        SUM(qty) qty,
                        invoice
                        FROM 
                        cart

                        LEFT JOIN
                        varian
                        ON
                        varian.id = cart.id_varian
                        LEFT JOIN
                        product
                        ON
                        product.id_product = varian.id_product

                        WHERE
                        invoice = '" . $invoice . "'
                        AND id_user = $id_user
                        )a
                        LEFT JOIN
                        auth_user
                        ON
                        auth_user.id = a.id_user
                        LEFT JOIN
                        invoice
                        ON
                        invoice.invoice = a.invoice
                        GROUP BY
                        invoice.invoice";
        $res = $this->db->query($query);
        return $res->row_array();
    }

    public function getVarian($id)
    {
        $query = "SELECT
                    varian_temp.id,
                    id_product,
                    master_color.color,
                    master_size.size
                    FROM
                    varian_temp
                    LEFT JOIN
                    master_color
                    ON
                    master_color.id = varian_temp.id_color
                    LEFT JOIN
                    master_size
                    ON
                    master_size.id = varian_temp.id_size
                    WHERE
                    id_product = '" . $id . "'";
        $res = $this->db->query($query);
        return $res->result_array();
    }

    public function  rowColor($id)
    {
        $query = "  SELECT
                    varian_temp.id_color,
                    master_color.color
                    FROM
                    varian_temp
                    LEFT JOIN
                    master_color
                    ON 
                    master_color.id = varian_temp.id_color
                    WHERE
                    id_product = '" . $id . "'
                    GROUP BY
                    master_color.id";
        $res = $this->db->query($query);
        return $res->result_array();
    }
    public function  rowSize($id)
    {
        $query = "  SELECT
                    varian_temp.id_size,
                    master_size.size
                    FROM
                    varian_temp
                    LEFT JOIN
                    master_size
                    ON 
                    master_size.id = varian_temp.id_size
                    WHERE
                    id_product = '" . $id . "'
                    GROUP BY
                    master_size.id";
        $res = $this->db->query($query);
        return $res->result_array();
    }
    public function  rowPose($id)
    {
        $query = "  SELECT
                    varian_temp.id_pose,
                    master_pose.pose
                    FROM
                    varian_temp
                    LEFT JOIN
                    master_pose
                    ON 
                    master_pose.id = varian_temp.id_pose
                    WHERE
                    id_product = '" . $id . "'
                    GROUP BY
                    master_pose.id";
        $res = $this->db->query($query);
        return $res->result_array();
    }

    public function payment($order_id, $transaction_status)
    {
        $invoice = $this->session->userdata('invoice');
        $data = [
            'invoice' => $invoice,
            'order_id' => $order_id,
            'transaction_status' => $transaction_status,
            'date_created' => date('Y-m-d H:i:sa')
        ];
        $res = $this->db->insert('payment', $data);
        if ($res) {
            return 1;
        } else {
            return 0;
        }
    }

    public function pesanan($id_user)
    {
        $query = "  SELECT
                    DISTINCT
                    a.*,
                    IF(invoice IS NULL,'Belum Dibayar','Sedang Dikemas') `status`,
                    invoice.kurir,
                    invoice.kurir_service,
                    invoice.kurir_etd,
                    invoice.kurir_price,
                    (jumlah + invoice.kurir_price + penanganan + adm) total 
                    FROM
                    (
                    SELECT
                    invoice invoice_number,
                    invoice_internal,
                    penanganan,
                    adm,
                    GROUP_CONCAT(DISTINCT product_name ORDER BY product_name ASC) product_name,
                    GROUP_CONCAT(DISTINCT image  ORDER BY product_name ASC) image,
                    GROUP_CONCAT(DISTINCT qty  ORDER BY product_name ASC) qty_a,
                    GROUP_CONCAT(price * qty  ORDER BY product_name ASC) price,
                    GROUP_CONCAT(DISTINCT uom) uom,
                    SUM(qty) qty,
                    GROUP_CONCAT(DISTINCT color   ORDER BY product_name ASC) color,
                    SUM(jumlah) jumlah
                    FROM
                    (
                    SELECT
                    DISTINCT
                    varian.id,
                    product.product_name,
                    product.image,
                    master_uom.uom,
                    master_color.color,
                    master_size.size,
                    cart.qty,
                    cart.invoice invoice_internal,
                    varian.price_diskon price,
                     IF(varian.price_diskon IS NULL,(cart.qty * varian.price),(cart.qty * varian.price_diskon))  jumlah,
                    2000 penanganan,
                    2000 adm,
                    invoice.kurir,
                    invoice.kurir_service,
                    invoice.kurir_etd,
                    invoice.kurir_price,
                    payment.invoice,
                    payment.transaction_status
                    FROM
                    cart
                    LEFT JOIN varian ON varian.id = cart.id_varian
                    LEFT JOIN product ON product.id_product = varian.id_product
                    LEFT JOIN invoice ON invoice.invoice = cart.invoice
                    LEFT JOIN payment ON payment.invoice = cart.invoice
                    LEFT JOIN master_uom ON master_uom.id = product.uom
                    LEFT JOIN master_size ON master_size.id = varian.id_size
                    LEFT JOIN master_color ON master_color.id = varian.id_color
                    WHERE
                    cart.id_user = '" . $id_user . "'


                    )a
                    GROUP BY
                    invoice_internal


                    )a
                    LEFT JOIN invoice ON invoice.invoice = a.invoice_number
                    ";
        $res = $this->db->query($query);
        return $res->result_array();
    }


    public function color($id_product)
    {
        $query = "SELECT
                    DISTINCT
                    varian.id,
                    varian.id_product,
                    master_color.color,
                    varian.id_color,
                    varian.image
                    FROM
                    varian
                    LEFT JOIN master_color ON master_color.id = varian.id_color
                    LEFT JOIN master_size ON master_size.id = varian.id_size
                    WHERE
                    varian.id_product = '" . $id_product . "'
                    GROUP BY
                    varian.id_product,
                    master_color.id";
        $res = $this->db->query($query);
        return $res->result_array();
    }
    public function size($id_product)
    {
        $query = "SELECT
                    DISTINCT
                    varian.id,
                    varian.id_product,
                    master_size.size,
                    varian.id_size,
                    varian.image
                    FROM
                    varian
                    LEFT JOIN master_size ON master_size.id = varian.id_size
                    WHERE
                    varian.id_product = '" . $id_product . "'
                    GROUP BY
                    varian.id_product,
                    master_size.id";
        $res = $this->db->query($query);
        return $res->result_array();
    }

    public function member()
    {
        $query = "  SELECT
                    firstName,
                    email,
                    alamat_user.telp,
                    kab_kurir.define_kabkot kabkot,
                    kec,
                    kel,
                    address
                    FROM
                    auth_user
                    LEFT JOIN alamat_user ON alamat_user.id_user = auth_user.id
                    LEFT JOIN kab_kurir ON kab_kurir.city_id = alamat_user.kabkot
                    WHERE
                    auth_user.active = 1
                    AND role_id = 3
                    GROUP BY
                    auth_user.id";
        $res = $this->db->query($query);
        return $res->result_array();
    }
    public function penjualan()
    {
        $query = "  SELECT
                    DISTINCT
                    inv.*,
                    invoice.kurir,
                    invoice.kurir_service,
                    invoice.kurir_desc,
                    invoice.kurir_etd,
                    invoice.kurir_price,
                    (kurir_price + total_belanja) total_pesanan
                    FROM
                    (
                    SELECT
                    date_created,
                    invoice,
                    order_id,
                    firstName,
                    kabkot,
                    transaction_status,
                    SUM(qty) qty,
                    SUM(jumlah) total_belanja
                    FROM
                    (
                    SELECT
                    DISTINCT
                    payment.date_created,
                    payment.invoice,
                    payment.order_id,
                    payment.transaction_status,
                    cart.qty,
                    varian.image,
                    varian.price,
                    varian.price_diskon,
                    IF(price_diskon IS NULL,price * qty,price_diskon * qty) jumlah,
                    varian.stock,
                    product.product_name,
                    master_color.color,
                    master_uom.uom,
                    master_size.size,
                    product.description,
                    auth_user.firstName,
                    auth_user.email,
                    auth_user.telp,
                    kab_kurir.define_kabkot kabkot,
                    alamat_user.kec,
                    alamat_user.kel,
                    alamat_user.address,
                    invoice.kurir,
                    invoice.kurir_desc,
                    invoice.kurir_service,
                    invoice.kurir_etd
                    FROM
                    payment
                    LEFT JOIN cart ON cart.invoice = payment.invoice
                    LEFT JOIN varian ON varian.id = cart.id_varian
                    LEFT JOIN product ON product.id_product = varian.id_product
                    LEFT JOIN auth_user ON auth_user.id = cart.id_user
                    LEFT JOIN alamat_user ON alamat_user.id_user = auth_user.id
                    LEFT JOIN invoice ON invoice.invoice = cart.invoice
                    LEFT JOIN master_color ON master_color.id = varian.id_color
                    LEFT JOIN master_size ON master_size.id = varian.id_size
                    LEFT JOIN master_uom ON master_uom.id = product.uom
                    LEFT JOIN kab_kurir ON kab_kurir.city_id = alamat_user.kabkot
                    ORDER BY
                    payment.date_created ASC	
                    )allData
                    GROUP BY
                    invoice
                    ) inv
                    LEFT JOIN invoice ON invoice.invoice = inv.invoice";
        $res = $this->db->query($query);
        return $res->result_array();
    }
}
