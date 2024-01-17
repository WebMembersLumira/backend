<?php 

namespace App\Repositories;
use Illuminate\Http\Request;
use App\Models\Portfolio;

class PortfolioRepository
{
    private $portfolio;

    public function __construct(Portfolio $portfolio)
    {
        $this->portfolio = $portfolio;
    }

    public function getAllPortfolio()
    {
        return  $this->portfolio->get();
    }

    public function createDataPortfolio(array $data)
    {
        return $this->portfolio->create($data);
    }

     public function getDataPortfolioById($id)
     {
        $dataPortfolio = $this->portfolio->find($id);
        return $dataPortfolio;
     }

    public function updateDataPortfolio(array $data, $id)
    {
        $dataPortfolio = $this->portfolio->find($id);
        $dataPortfolio->update($data);
        return $dataPortfolio;
    }

    public function deleteDataPortfolio($id)
    {
        $dataPortfolio = $this->portfolio->find($id);
        $dataPortfolio->delete($id);
        return 'data berhasil di hapus';
    }
}