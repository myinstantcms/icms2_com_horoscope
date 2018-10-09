<?php

	class modelHoroscope extends cmsModel
	{

		public function getHoroscope($name, $sort)
		{
			return $this->filterEqual('name', $name)
			            ->filterEqual('plan', $sort)
			            ->getItem('horoscope');
		}

		public function parseHoroscope()
		{
			require_once __DIR__ . '/vendor/phpQuery/phpQuery.php';

			$array = $this->initHoroscope();

			foreach ($array as $key => $value) {
				foreach ($value['horoscope'] as $k => $v) {
					$url = "https://horo.mail.ru/prediction/{$key}/{$k}/";

					$homepage = $this->getPage($url);//file_get_contents($url);
					$doc      = phpQuery::newDocument($homepage);
					$doc      = $doc->find('.p-prediction');

					$doc->find('.article__item_html > p > a')
					    ->remove();

					$forecast = $doc->find('.text.text_block.text_light_small span.link .link__text')
					                ->text();
					$title    = $doc->find('.hdr__inner')
					                ->text();
					$text     = $doc->find('.article__item_html')
					                ->html();
					unset($doc);

					$data = [
						'name'     => $key,
						'plan'     => $k,
						'forecast' => $forecast,
						'title'    => $title,
						'text'     => $text,
					];

					$this->insertOrUpdate('horoscope', $data);
				}
			}
		}

		private function getPage($url)
		{
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_HEADER, 1);

			$doc = curl_exec($ch);
			curl_close($ch);

			return $doc;
		}

		public function initHoroscope()
		{
			$str = 'aries|Овен|21 марта — 19 апреля|21.03 — 19.04||taurus|Телец|20 апреля — 20 мая|20.04 — 20.05||gemini|Близнецы|21 мая — 21 июня|21.05 — 21.06||cancer|Рак|22 июня — 22 июля|22.06 — 22.07||leo|Лев|23 июля — 22 августа|23.07 — 22.08||virgo|Дева|23 августа — 22 сентября|23.08 — 22.09||libra|Весы|23 сентября — 23 октября|23.09 — 23.10||scorpio|Скорпион|24 октября — 22 ноября|24.10 — 22.11||sagittarius|Стрелец|23 ноября — 21 декабря|23.11 — 21.12||capricorn|Козерог|22 декабря — 19 января|22.12 — 19.01||aquarius|Водолей|20 января — 18 февраля|20.01 — 18.02||pisces|Рыбы|19 февраля — 20 марта|19.02 — 20.03';

			$year = date('Y');

			$plan = [
				'yesterday' => ['name' => 'Вчера'],
				'today'     => ['name' => 'Сегодня'],
				'tomorrow'  => ['name' => 'Завтра'],
				'week'      => ['name' => 'Неделя'],
				'month'     => ['name' => 'Месяц'],
				'year'      => ['name' => $year],
			];

			$str = explode('||', $str);

			$horoscope = [];

			foreach ($str as $key => $value) {
				$value = explode('|', $value);

				$horoscope[$value[0]]['name']      = $value[1];
				$horoscope[$value[0]]['date']      = $value[2];
				$horoscope[$value[0]]['dates']     = $value[3];
				$horoscope[$value[0]]['horoscope'] = $plan;
			}

			return $horoscope;
		}

	}
