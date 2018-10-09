<?php

	class actionHoroscopeAjax extends cmsAction
	{
		public function run($name, $sort = 'today')
		{
			$is_sort = $this->request->get('is_sort');

			if (!$name) {
				return cmsCore::error404();
			}

			$year = date('Y');

			$plan = [
				'yesterday' => ['name' => 'Вчера'],
				'today'     => ['name' => 'Сегодня'],
				'tomorrow'  => ['name' => 'Завтра'],
				'week'      => ['name' => 'Неделя'],
				'month'     => ['name' => 'Месяц'],
				'year'      => ['name' => $year],
			];

			$data = $this->model->getHoroscope($name, $sort);

			if ($is_sort) {

				$html = cmsTemplate::getInstance()
				                   ->render('ajax', [
					                   'name'    => $name,
					                   'sort'    => $sort,
					                   'data'    => $data,
					                   'plan'    => $plan,
					                   'is_sort' => 1,
				                   ], new cmsRequest([], cmsRequest::CTX_INTERNAL));

				cmsTemplate::getInstance()
				           ->renderJSON([
					           'html' => $html,
				           ]);
			}

			return cmsTemplate::getInstance()
			                  ->render('ajax', [
				                  'name'    => $name,
				                  'sort'    => $sort,
				                  'data'    => $data,
				                  'plan'    => $plan,
				                  'is_sort' => 0,
			                  ], new cmsRequest([], cmsRequest::CTX_AJAX));

		}
	}
