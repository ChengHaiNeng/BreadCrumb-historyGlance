
//面包屑制作
GoodsController:
	public function goods(){
	
	$goods_id = I('goods_id');
	$goods = $goodsModel->find($goods_id);
	//加入历史浏览记录
	if($goods){
			$this->history($goods);
	}
	//面包屑制作	
	$cat_id = $goods['cat_id'];
	$cat_id = $goods['cat_id'];
		$catModel = D('Admin/cat');
		$row = $catModel->find($cat_id);	
		$arr = array();	
		$arr[] = $row;
		while($row['parent_id']>0){
			$row = $catModel->find($row['parent_id']);
			$arr[] = $row;
		}
		//传递面包屑
		$this->assign('bread',array_reverse($arr));
		
	}
$this->assign('bread',array_reverse($arr));

//面包屑显示
goods.html
<foreach name = 'bread'  item ='b'>
 <a href="">{$b['cat_name']}</a> <code>&gt;</code>  
</foreach>	


//历史浏览记录，加入到session中
GoodsController:
	public function history($goods){
		$history = session('?history')?session('history'):array();
		$row = array();
		$row['goods_id'] = $goods['goods_id'];
		$row['goods_name'] = $goods['goods_name'];
		$row['shop_price'] = $goods['shop_price'];

		$history[$goods['goods_id']] = $row;

		if(count($history)>5){
			$key = key($history);
			unset($history[$key]);
		}
		
		session('history',$history);
	}
