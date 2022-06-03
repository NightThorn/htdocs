<?php
class ggs_post_model extends MY_Model
{
	public $tb_account_manager = "sp_account_manager";

	public function __construct()
	{
		parent::__construct();
		$module_path = get_module_directory(__DIR__);

		//
		$this->module_name = get_module_config($module_path, 'name');
		$this->module_icon = get_module_config($module_path, 'icon');
		$this->module_color = get_module_config($module_path, 'color');
		//

		$this->module_img = get_module_config($module_path, 'img');

		$app_id = get_option('ggs_consumer_key', '');
		$app_secret = get_option('ggs_consumer_secret', '');
	}

	public function block_permissions($path = "")
	{
		$dir = get_directory_block(__DIR__, get_class($this));
		return [
			'position' => 9000,
			'name' => $this->module_name,
			'color' => $this->module_color,
			'icon' => $this->module_icon,
			'img' => $this->module_img,
			'id' => str_replace("_model", "", get_class($this)),
			'html' => view($dir . 'pages/block_permissions', ['path' => $path], true, $this),
		];
	}

	public function block_report($path = "")
	{
		$dir = get_directory_block(__DIR__, get_class($this));
		return [
			'tab' => 'ggs',
			'position' => 1000,
			'name' => $this->module_name,
			'color' => $this->module_color,
			'icon' => $this->module_icon,
			'img' => $this->module_img,
			'id' => str_replace("_model", "", get_class($this)),
			'html' => view($dir . 'pages/block_report', ['path' => $path], true, $this),
		];
	}

	public function block_post_preview($path = "")
	{
		$dir = get_directory_block(__DIR__, get_class($this));
		return [
			'position' => 1000,
			'name' => $this->module_name,
			'color' => $this->module_color,
			'icon' => $this->module_icon,
			'img' => $this->module_img,
			'id' => str_replace("_model", "", get_class($this)),
			'preview' => view($dir . 'pages/preview', ['path' => $path], true, $this),
		];
	}

	public function post($data)
	{
		$post_type = $data["post_type"];
		$account = $data["account"];
		$medias = $data["medias"];
		$link = $data["link"];
		$advance = $data["advance"];
		$caption = spintax($data["caption"]);
		$is_schedule = $data["is_schedule"];
		$endpoint = "/" . $account->pid . "/";
		$params = [];

		if ($post_type == "photo" || $post_type == "video") {
			$post_type = "media";
		}

		if ($is_schedule) {
			return [
				"status" => "success",
				"message" => __('Success'),
				"type" => $post_type
			];
		}

		switch ($post_type) {
			case 'media':

				if (count($medias) == 1) {
					if (is_photo($medias[0])) {
						$medias[0] = watermark($medias[0], $account->team_id, $account->id);

						$path = $medias[0];
						$type = pathinfo($path, PATHINFO_EXTENSION);
						$data = file_get_contents($path);
						$b64image = 'data:image/' . $type . ';base64,' . base64_encode($data);
						$endpoint .= "photos";

						$params = ['message' => $caption, 'user_id' => $account->pid, 'picture' => $b64image];
						$test = json_encode($params);
					} else {

						$endpoint .= "videos";

						$path = $medias[0];
						$type = pathinfo($path, PATHINFO_EXTENSION);
						$data = file_get_contents($path);
						$b64vid = 'data:video/' . $type . ';base64,' . base64_encode($data);
						$params = ['message' => $caption, 'user_id' => $account->pid, 'video' => $b64vid];
						$test = json_encode($params);
					}
				} else {

					$media_ids = [];
					$success_count = 0;
					foreach ($medias as $key => $media) {
						if (is_photo($media)) {
							$media = watermark($media, $account->team_id, $account->id);
							$medias[$key] = $media;

							$path = $medias[$key];
							$type = pathinfo($path, PATHINFO_EXTENSION);
							$data = file_get_contents($path);
							$b64image = 'data:image/' . $type . ';base64,' . base64_encode($data);
							$params = ['message' => $caption, 'user_id' => $account->pid, 'picture' => $b64image];
							$test = json_encode($params);

							try {
								$url = 'https://ggs.tv/api/v1/post.php?action=post';

								$ch = curl_init($url);
								curl_setopt($ch, CURLOPT_POST, 1);
								curl_setopt($ch, CURLOPT_POSTFIELDS, $test);
								curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
								curl_setopt($ch, CURLOPT_HEADER, 0);
								curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

								$response = curl_exec($ch);

								$post_id =  $response['id'];
								unlink_watermark($medias);
								return [
									"status" => "success",
									"message" => __('Success dudeee'),
									"id" => $post_id,
									"url" => "https://ggs.tv/post/" . $post_id,
									"type" => $post_type
								];
								$success_count++;
							} catch (Exception $e) {
							}
						} else {
							if ($account->category != "page") {
								$params = ['message' => $caption, 'user_id' => $account->pid, 'video' => $media];
								$test = json_encode($params);
								try {
									$url = 'https://ggs.tv/api/v1/post.php?action=post';

									$ch = curl_init($url);
									curl_setopt($ch, CURLOPT_POST, 1);
									curl_setopt($ch, CURLOPT_POSTFIELDS, $test);
									curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
									curl_setopt($ch, CURLOPT_HEADER, 0);
									curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

									$response = curl_exec($ch);

									$post_id =  $response['id'];
									unlink_watermark($medias);
									return [
										"status" => "success",
										"message" => __('Success dudeee'),
										"id" => $post_id,
										"url" => "https://ggs.tv/post/" . $post_id,
										"type" => $post_type
									];
									$success_count++;
								} catch (Exception $e) {
								}
							}
						}
					}

					$endpoint .= "feed";
					$params = ['message' => $caption];

					$params += $media_ids;
				}

				break;

			case 'link':
				
				$endpoint .= "feed";
				$params = ['message' => $caption. " " .$link, 'user_id' => $account->pid];
				$test = json_encode($params);

				break;

			case 'text':

				$endpoint .= "feed";
				$params = ['message' => $caption, 'user_id' => $account->pid];
				$test = json_encode($params);

				break;
		}

		try {


			$url = 'https://ggs.tv/api/v1/post.php?action=post';

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $test);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

			$response = curl_exec($ch);

			$post_id =  $response['id'];
			unlink_watermark($medias);
			return [
				"status" => "success",
				"message" => __('Success dudeee'),
				"id" => $post_id,
				"url" => "https://ggs.tv/post/" . $post_id,
				"type" => $post_type
			];
		} catch (Exception $e) {
			if ($e->getCode() == 190) {
				$this->model->update($this->tb_account_manager, ["status" => 0], ["id" => $account->id]);
			}
			unlink_watermark($medias);
			return [
				"status" => "error",
				"message" => __($e->getMessage()),
				"type" => $post_type
			];
		}
	}
}
