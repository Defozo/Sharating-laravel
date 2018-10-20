<?php

namespace App\Http\Controllers;

use Exception;
use GuzzleHttp\Exception\ClientException;
use Zttp\Zttp;

class BlockchainController extends Controller
{
    /**
     * Sends data to blockchain and returns transaction hash where the data is stored.
     *
     * @param $data string any data which hash you want to put on blockchain
     * @return string transaction hash from which you can generate link to etherscan.io like this:
     * https://ropsten.etherscan.io/tx/{RETURNED_TRANSACTION_HASH}
     * @see getLinkToEtherscanShowingTransaction
     */
    public function getTransactionHashFromBlockchain($data)
    {
        try {
            $response = Zttp::post(sprintf(config('services.blockchain.endpoints.get_transaction_hash')), $data);
            if ($response->status() !== 200) {
                throw new Exception;
            }
            return $response;
        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * Generates link to Etherscan.io where the transaction data is shown.
     *
     * @param $transactionHash string Transaction hash
     * @return string URL to Etherscan.io showing transaction information.
     */
    public function getLinkToEtherscanShowingTransaction($transactionHash) {
        return "https://ropsten.etherscan.io/tx/{$transactionHash}";
    }
}